<?php

use Phinx\Migration\AbstractMigration;

class UserMigrate extends AbstractMigration
{
  /**
   * Change Method.
   *
   * Write your reversible migrations using this method.
   *
   * More information on writing migrations is available here:
   * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
   *
   * The following commands can be used in this method and Phinx will
   * automatically reverse them when rolling back:
   *
   *    createTable
   *    renameTable
   *    addColumn
   *    renameColumn
   *    addIndex
   *    addForeignKey
   *
   * Remember to call "create()" or "update()" and NOT "save()" when working
   * with the Table class.
   */
  public function change()
  {
        // create the table
    $table = $this->table('users', array('id' => true, 'primary_key' => 'id'));
    $table->addColumn('nome', 'string', array('limit' => 100))
      ->addColumn('email', 'string', array('limit' => 100))
      ->addColumn('hash', 'text')
      ->addColumn('created_at', 'datetime')
      ->addColumn('updated_at', 'datetime')
      ->create();
  }

  public function up()
  {

  }

  public function down()
  {

  }

}
