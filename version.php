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
 * Defines the version of mirotranslate
 *
 * @package   mod_mirotranslate
 * @copyright 2020 Samuel Calegari <samuel.calegari@univ-perp.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2022042700;            // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2018050800;            // Requires this Moodle version
$plugin->component = 'mod_mirotranslate';   // Full name of the plugin (used for diagnostics)
$plugin->release = 'v1.2';
$plugin->maturity = MATURITY_STABLE;
$plugin->cron      = 0;
