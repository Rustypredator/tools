/**
 * McOvCFGGen
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/tools-homepage
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Florian Steltenkamp <contact@rusty.info>
 */

/**
 * Extends the Worlds Form
 * @return void
 */
function addWorlds() {
    $("#worlds_form").append($('<div class="panel panel-primary" id="world_"><div class="panel-heading">New World:<span class="pull-right" role="button" onclick="rempanel('world_')"><i class="fa fa-lg fa-times"></i></span></div><div class="panel-body"><div class="form-group"><label for="worlds1name">Name of the World</label><input type="text" name="worlds[1][name]" class="form-control"/></div><div class="form-group"><label for="worlds1path">Path to the world</label><input type="text" name="worlds[1][path]" class="form-control"/></div></div></div>'));
}
function addFilter() {
    $("#filters_form").append($());
}
function addMarker() {
    $("#markers_form").append($());
}
function rempanel(panelid) {
    $(panelid).remove();
}
