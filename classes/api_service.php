<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * local_moyclass file description here.
 *
 * @package    local_moyclass
 * @copyright  2022 mac <kamenik1@icloud.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_moyclass;
use dml_exception;

require_once("{$CFG->libdir}/filelib.php");

/**
 * Service for obtaining data via api My class
 */
class api_service {
    private static $host_url = "https://api.moyklass.com/v1/company/";

    /**
     * Authorization. Obtaining a token for working with the API.
     *
     * @return bool
     */
    public function get_auth_token() {
        $api_key = get_config('local_moyclass', 'apikey');
        $url = self::$host_url . "auth/getToken";
        try {
            $response = $this->api()->post($url, json_encode(['apiKey' => $api_key]));
            return json_decode($response);
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * Obtaining information about school employees
     *
     * @return array
    */
    public function get_managers(): array {
        $url = self::$host_url . "managers";
        try {
            $response = $this->api()->get($url);
            return json_decode($response, true);
        } catch (dml_exception $e) {
            error_log("Error retrieving manager: " . $e->getMessage());
            return [];
        }
    }

    /**
     * We receive information about school students
     *
     * @return false|mixed
     */
    public function get_students(): array {
        $url = self::$host_url . "users";
        try {
            $response = $this->api()->get($url, ['includePayLink' => 'true', 'limit' => 500]);
            $decoded_response = json_decode($response, true);
            if (is_array($decoded_response) && isset($decoded_response['users'])) {
                return $decoded_response['users'];
            } else {
                // Logiranje greške ako odgovor nije u očekivanom formatu
                error_log("Odgovor nije niz ili nedostaju korisnici: " . $response);
                return [];
            }
        } catch (dml_exception $e) {
            // Logiranje izuzetka
            error_log("Došlo je do izuzetka u get_students: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Information about student groups
     *
     * @return false|mixed
     */
    public function get_joins() {
        $url = self::$host_url . "joins";
        try {
            $response = $this->api()->get($url);
            return json_decode($response, true)['joins'];
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * Information about school groups
     *
     * @return false|mixed
     */
    public function get_classes() {
        $url = self::$host_url . "classes";
        try {
            $response = $this->api()->get($url);
            $decoded_response = json_decode($response, true);
            if (is_null($decoded_response)) {
                throw new Exception("Bad JSON response");
            }
            return $decoded_response;
        } catch (dml_exception $e) {
            error_log("An exception occurred in get_classes: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Information about school students' activities
     *
     * @return false|mixed
     */
    public function get_lessons(): array {
        $first_date = date("Y-m-d", strtotime("-30 days"));
        $second_date = date("Y-m-d", strtotime("30 days"));
        $url = self::$host_url . "lessons?date={$first_date}&date={$second_date}&limit=500&includeRecords=true";
        try {
            $response = $this->api()->get($url);
            $decoded_response = json_decode($response, true);
            return $decoded_response['lessons'] ?? [];
        } catch (dml_exception $e) {
            // Logging information about the exception
            error_log("Došlo je do iznimke: " . $e->getMessage());
            error_log("Trag greške: " . $e->getTraceAsString());

            // Return an empty string or other appropriate value
            return [];
        }
    }

    /**
     * We get a list of student registrations for classes
     * @return array|false
     */
    public function get_lesson_records(): array {
        $first_date = date("Y-m-d", strtotime("-30 days"));
        $second_date = date("Y-m-d", strtotime("30 days"));
        $url = self::$host_url . "lessonRecords?date={$first_date}&date={$second_date}&limit=500";
        try {
            $response = $this->api()->get($url);
            return json_decode($response, true)['lessonRecords'];
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * Getting client statuses
     *
     * @return void
     */
    public function get_client_statuses(): array {
        $url = self::$host_url . "clientStatuses";
        try {
            $response = $this->api()->get($url);
            return json_decode($response, true);
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * Getting the types of subscriptions
     *
     * @return void
     */
    public function get_subscriptions(): array {
        $url = self::$host_url . "subscriptions";
        try {
            $response = $this->api()->get($url);
            $decoded_response = json_decode($response, true);
            return $decoded_response['subscriptions'] ?? [];
        } catch (dml_exception $e) {
            error_log("Došlo je do iznimke: " . $e->getMessage());
            error_log("Trag greške: " . $e->getTraceAsString());
            return [];
        }
    }

    /**
     * We receive student subscriptions
     *
     * @return void
     */
    public function get_user_subscriptions(): array {
        $url = self::$host_url . "userSubscriptions";
        try {
            $response = $this->api()->get($url);
            $decoded_response = json_decode($response, true);
            return $decoded_response['subscriptions'] ?? [];
        } catch (dml_exception $e) {
            error_log("Došlo je do izuzetka u get_user_subscriptions: " . $e->getMessage());
            error_log("Trag greške: " . $e->getTraceAsString());
            return [];
        }
    }

    /**
     * Receiving successful student payments
     *
     * @return void
     */
    public function get_payments(): array {
        $url = self::$host_url . "payments";
        try {
            $response = $this->api()->get($url, ['optype' => 'income']);
            $decoded_response = json_decode($response, true);
            return $decoded_response['payments'] ?? [];
        } catch (dml_exception $e) {
            error_log("Došlo je do izuzetka u get_payments: " . $e->getMessage());
            error_log("Trag greške: " . $e->getTraceAsString());
            return [];
        }
    }

    /**
     * We receive invoices for payments for students
     *
     * @return void
     */
    public function get_invoices() {
        $url = self::$host_url . "invoices";
        try {
            $response = $this->api()->get($url);
            return json_decode($response, true)['invoices'];
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * We cancel the lesson
     * @param $recordId
     * @return bool
     */
    public function cancel_lesson($recordId): bool {
        $url = self::$host_url . "lessonRecords/" . $recordId;
        try {
            $this->api()->delete($url);
            return true;
        } catch (dml_exception $e) {
            return false;
        }
    }

    /**
     * Config api for backend CRM
     *
     * @return \curl
     * @throws dml_exception*@throws dml_exception
     */
    private function api(): \curl {
        global $DB;
        $x_access_token = $DB->get_record('local_moyclass_auth', ['active' => '1']);
        $header = ['Content-Type: application/json', 'Accept: application/json'];
        if ($x_access_token) {
            $header[] = "x-access-token:{$x_access_token->accesstoken}";
        } else {
            // Logging or handling the situation when the token is not available
            error_log("The API access token is not available.");
        }
        $curl = new \curl();
        $curl->setHeader($header);
        return $curl;
    }
}