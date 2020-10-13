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
 * Prints a particular instance of mirotranslate
 *
 * @package   mod_mirotranslate
 * @copyright 2020 Samuel Calegari <samuel.calegari@univ-perp.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // mirotranslate instance ID - it should be named as the first character of the module

if ($id) {
    $cm         = get_coursemodule_from_id('mirotranslate', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $mirotranslate  = $DB->get_record('mirotranslate', array('id' => $cm->instance), '*', MUST_EXIST);
} elseif ($n) {
    $mirotranslate  = $DB->get_record('mirotranslate', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $mirotranslate->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('mirotranslate', $mirotranslate->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_mirotranslate\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $mirotranslate);
$event->trigger();

/// Print the page header

$PAGE->set_url('/mod/mirotranslate/view.php', array('id' => $cm->id));
$PAGE->set_title($mirotranslate->name);
$PAGE->set_heading($course->shortname);

// Output starts here
echo $OUTPUT->header();

// Replace the following lines with you own code
echo $OUTPUT->heading($mirotranslate->name);

$addClasses = '';
const RATIO = '1by1';

if ($mirotranslate->intro) {
    echo $OUTPUT->box(format_module_intro('mirotranslate', $mirotranslate, $cm->id), 'generalbox mod_introbox', 'mirotranslateintro');
} else {
    $addClasses = ' py-3';
}

$html  = '<div class="container'. $addClasses .'">';
$html .= '<div class="row">';
$html .= '<div class="col-sm-12">';
$html .= '<div class="card text-center">';
$html .= '<div class="card-block">';
$html .= '<div class="embed-responsive embed-responsive-' . RATIO . '">';
$html .= '<iframe class="embed-responsive-item" title="' . $mirotranslate->name . '" src="' . $mirotranslate->externalurl . '" allowfullscreen></iframe>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';

echo($html);

// Finish the page
echo $OUTPUT->footer();
