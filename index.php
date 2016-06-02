<?php

$arrConfig = [];
/**
 * Connection string to your MySql database
 * Please ensure, that you have defined your connection string properly.
 * Ensure, that details like 'charset=UTF8' are included in your connection string (if necessary).
 */
$arrConfig['source'] = 'mysql:host=localhost;port=3306;dbname=your_db_name;charset=UTF8,your_user_name,your_password';
/**
 * Connection string to your PostgreSql database
 * Please ensure, that you have defined your connection string properly.
 * Ensure, that details like options='[double dash]client_encoding=UTF8' are included in your connection string (if necessary).
 */
$arrConfig['target'] = 'pgsql:host=localhost;port=5432;dbname=your_pg_db_name;options=--client_encoding=UTF8,your_user_name,your_password';
/**
 * PHP encoding type.,
 * If not supplied, then UTF-8 will be used as a default.
 */
$arrConfig['encoding'] = 'UTF-8';
/**
 * schema - a name of the schema, that will contain all migrated tables.
 * Default is 'public', which will cause the new tables to appear at the top level of the database defined above in 'target'
 * If not supplied, then a new schema will be created automatically.
 */
$arrConfig['schema'] = 'public';
/**
 * During migration each table's data will be split into chunks of <data_chunk_size> (in MB).
 * If not supplied, then 10 MB will be used as a default.
 */
$arrConfig['data_chunk_size'] = 10;
/**
 * Flag, that allows to migrate only the data.
 * By default, ti is false - entire db-structure + data
 * In order to migrate data only - set true
 */
$arrConfig['data_only'] = false;

$migration = new \jumper423\migration\FromMySqlToPostgreSql($arrConfig);
$migration->migrate();


