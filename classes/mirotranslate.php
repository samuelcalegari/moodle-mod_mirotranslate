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
 * The mod_mirotranslate main class.
 *
 * @package   mod_mirotranslate
 * @copyright 2020 Samuel Calegari <samuel.calegari@univ-perp.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_mirotranslate;

use renderable;
use renderer_base;
use templatable;
use stdClass;

class mirotranslate implements renderable, templatable {
    /** @var object $mirotranslate_instance Some text to show how to pass data to a template. */
    var $title = null;
    var $url = null;
    var $intro = null;

    public function __construct($mirotranslate_instance) {
        $this->title= $mirotranslate_instance->name;
        $this->url= $mirotranslate_instance->externalurl;
        $this->intro = ($mirotranslate_instance->intro != "");
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->title = $this->title;
        $data->url = $this->url;
        $data->intro = $this->intro;
        $data->ratio = '1by1';
        return $data;
    }
}