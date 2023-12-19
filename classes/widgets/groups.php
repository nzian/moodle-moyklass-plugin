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

namespace local_moyclass\widgets;

use local_moyclass\pages;

class groups {
    public function get_groups() {
        global $OUTPUT, $DB, $USER;
        // TODO: in the future there should be an email from $USER->email ['email' => $USER->email]
        $student = $DB->get_record("local_moyclass_students", ['email' => "davor@vokabula.com"]);
        $joins = $DB->get_records('local_moyclass_joins', ['userid' => $student->studentid]);
        $groups = '';

        $error = new pages();
        if (!$joins) {
            return $error->error_alert("No group entries found");
        }

        foreach ($joins as $join) {
            $groups .= $this->get_group($join);
        }

        $templatecontext = (object) [
            'groups' => $groups,
        ];

        return $OUTPUT->render_from_template('local_moyclass/widgets/groups', $templatecontext);
    }

    public function get_group($join) {
        global $OUTPUT, $DB;
        $group = $DB->get_record('local_moyclass_classes', ['classid' => $join->classid]);

        $error = new pages();
        if (!$group) {
            return $error->error_alert("Group not found");
        }

        $originalNextDate = $join->nextrecord;
        $newDate = null;
        if ($originalNextDate) {
            $newDate = date('d.m', strtotime($originalNextDate));
        }

        $templatecontext = (object) [
            'newNextDate' => $newDate,
            'name_group' => $group->name,
            'group' => $join
        ];

        return $OUTPUT->render_from_template('local_moyclass/widgets/group', $templatecontext);
    }
}