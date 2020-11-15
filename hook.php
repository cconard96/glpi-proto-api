<?php
/*
 -------------------------------------------------------------------------
 API
 Copyright (C) 2020 by Curtis Conard
 https://github.com/cconard96/glpi-api-plugin
 -------------------------------------------------------------------------
 LICENSE
 This file is part of API.
 API is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.
 API is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 You should have received a copy of the GNU General Public License
 along with API. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
*/

function plugin_api_install()
{
	$migration = new PluginApiMigration(PLUGIN_API_VERSION);
	$migration->applyMigrations();
	return true;
}

function plugin_api_uninstall()
{
	return true;
}

