<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_message extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'text'       => [
                'type'           => 'TEXT',
                'null'           => TRUE,
            ],
            'password' => [
                'type'           => 'TEXT',
                'null'           => TRUE,
            ],
            'url' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],

        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addKey('url',FALSE, TRUE);
        $this->forge->createTable('message');
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('message');
	}
}
