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

// This file keeps track of upgrades to
// the wordcards module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

defined('MOODLE_INTERNAL') || die();

function xmldb_wordcards_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

    if ($oldversion < 2016080200) {

        // Define field skipglobal to be added to wordcards.
        $table = new xmldb_table('wordcards');
        $field = new xmldb_field('skipglobal', XMLDB_TYPE_INTEGER, '1', null, null, null, '1', 'timemodified');

        // Conditionally launch add field skipglobal.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Wordcards savepoint reached.
        upgrade_mod_savepoint(true, 2016080200, 'wordcards');
    }

    if ($oldversion < 2016080500) {

        // Define field finishedscattermsg to be added to wordcards.
        $table = new xmldb_table('wordcards');
        $field = new xmldb_field('finishedscattermsg', XMLDB_TYPE_TEXT, null, null, null, null, null, 'skipglobal');

        // Conditionally launch add field finishedscattermsg.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

         // Define field completedmsg to be added to wordcards.
        $table = new xmldb_table('wordcards');
        $field = new xmldb_field('completedmsg', XMLDB_TYPE_TEXT, null, null, null, null, null, 'finishedscattermsg');

        // Conditionally launch add field completedmsg.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Wordcards savepoint reached.
        upgrade_mod_savepoint(true, 2016080500, 'wordcards');
    }

    if ($oldversion < 2019041200) {

        // Define field skipglobal to be added to wordcards.
        $table = new xmldb_table('wordcards');
        $field = new xmldb_field('localpracticetype', XMLDB_TYPE_INTEGER, '2', null, null, null, '0', 'timemodified');

        // Conditionally launch add field skipglobal.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }


        $field = new xmldb_field('globalpracticetype', XMLDB_TYPE_INTEGER, '2', null, null, null, '0', 'timemodified');

        // Conditionally launch add field skipglobal.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Wordcards savepoint reached.
        upgrade_mod_savepoint(true, 2019041200, 'wordcards');
    }
    if ($oldversion < 2019091401) {

        // Define field image to be added to wordcard terms.
        $table = new xmldb_table('wordcards_terms');
        $field = new xmldb_field('image', XMLDB_TYPE_TEXT, null, null, null, null, null);

        // Conditionally launch add field skipglobal.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        //define audio to be added to wordcard terms
        $field = new xmldb_field('audio', XMLDB_TYPE_TEXT, null, null, null, null, null);
        // Conditionally launch add field skipglobal.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Wordcards savepoint reached.
        upgrade_mod_savepoint(true, 2019091401, 'wordcards');
    }

    return true;
}