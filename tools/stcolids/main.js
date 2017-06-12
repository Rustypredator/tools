/**
 * stcolids
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/stcolids
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
function pull_collection() {
    collectionid = $('#form_collection').val();
    if (collectionid=="") {
        alert("Please fill out the ID Field in the form!");
        exit;
    } else {
        dataString = "collection="+collectionid;
        $.ajax (
            {
                type: 'POST',
                url: 'http://tools.rusty.info/stcolids/ajax/getcol.php',
                data: dataString,
                cache: false,
                beforeSend: function() {
                    //exec before sending
                },
                success: function(data) {
                    //on message recieved
                    var obj = JSON.parse(data);
                    if (obj.type == 'success') {
                        //get steam stuff successfull
                        $('#table_removeme').remove();
                        $('#badge_count').append(obj.modscount)
                        var modsdata = obj.modsdata;
                        modsdata.forEach(function(entry) {
                            $('#raw_ids').append(entry.id+'\n');
                            $('#table_fillme').append('<tr><td>'+entry.id+'</td><td>'+entry.name+'</td><td><a href="'+entry.url+'">Workshop Link</a></td></tr>');
                        });
                    } else {
                        //failed. display message
                        alert(obj.message);
                    }
                }
            }
        )
    }
}
