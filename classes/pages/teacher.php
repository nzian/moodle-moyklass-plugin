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

namespace local_moyclass\pages;

use local_moyclass\manager_db;
use local_moyclass\widgets\manage_lessons;

class teacher {
    public function render() {
        global $OUTPUT;

        $lessons = new manage_lessons();

        $managerDB = new manager_db();
        $managerDB->set_lessons();

        $templatecontext = (object) [
            'lessons' => $lessons->get_lessons(),
        ];

        return $OUTPUT->render_from_template('local_moyclass/pages/teacher/container', $templatecontext);
    }
}