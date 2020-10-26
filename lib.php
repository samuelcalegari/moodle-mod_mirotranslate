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
 * Library of interface functions and constants for module mirotranslate
 *
 * @package   mod_mirotranslate
 * @copyright 2020 Samuel Calegari <samuel.calegari@univ-perp.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $mirotranslate An object from the form in mod_form.php
 * @return int The id of the newly inserted mirotranslate record
 */
function mirotranslate_add_instance($mirotranslate) {
    global $DB;

    $mirotranslate->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('mirotranslate', $mirotranslate);
}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $mirotranslate An object from the form in mod_form.php
 * @return boolean Success/Fail
 */
function mirotranslate_update_instance($mirotranslate) {
    global $DB;

    $mirotranslate->timemodified = time();
    $mirotranslate->id = $mirotranslate->instance;

    return $DB->update_record('mirotranslate', $mirotranslate);
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function mirotranslate_delete_instance($id) {
    global $DB;

    if (! $mirotranslate = $DB->get_record('mirotranslate', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('mirotranslate', array('id' => $mirotranslate->id));

    return true;
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 **/
function mirotranslate_cron () {
    return true;
}

/**
 * Execute post-uninstall custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 */
function mirotranslate_uninstall() {
    return true;
}
