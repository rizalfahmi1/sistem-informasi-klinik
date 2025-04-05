<?php

use yii\db\Migration;

/**
 * Class m250404_024009_create_tabel_data_master
 */
class m250404_024009_create_tabel_data_master extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('wilayah', [
            'id' => $this->primaryKey(),
            'nama_wilayah' => $this->string(100)->notNull(),
            'jenis_wilayah' => "ENUM('Provinsi','Kabupaten/Kota','Kecamatan','Kelurahan/Desa') NOT NULL",
            'id_induk' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_wilayah_induk',
            'wilayah',
            'id_induk',
            'wilayah',
            'id'
        );

        // Tabel Pegawai
        $this->createTable('pegawai', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->unique(),
            'nik' => $this->string(20)->unique(),
            'nama_lengkap' => $this->string(100)->notNull(),
            'jenis_kelamin' => $this->integer()->notNull(),
            'tanggal_lahir' => $this->integer()->notNull(),
            'alamat' => $this->text()->notNull(),
            'nomor_telepon' => $this->string(20)->notNull(),
            'jabatan' => $this->string(50)->notNull(),
            'tanggal_bergabung' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_pegawai_pengguna',
            'pegawai',
            'id_user',
            'user',
            'id'
        );

        // Tabel Tindakan
        $this->createTable('tindakan', [
            'id' => $this->primaryKey(),
            'kode_tindakan' => $this->string(20)->notNull()->unique(),
            'nama_tindakan' => $this->string(100)->notNull(),
            'deskripsi' => $this->text(),
            'biaya' => $this->decimal(12, 2)->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // Tabel Obat
        $this->createTable('obat', [
            'id' => $this->primaryKey(),
            'kode_obat' => $this->string(20)->notNull()->unique(),
            'nama_obat' => $this->string(100)->notNull(),
            'id_jenis_obat' => $this->integer(),
            'satuan' => $this->string(20)->notNull(),
            'stok' => $this->integer()->notNull()->defaultValue(0),
            'harga_beli' => $this->decimal(12, 2)->notNull(),
            'harga_jual' => $this->decimal(12, 2)->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->createTable('jenis_obat', [
            'id' => $this->primaryKey(),
            'nama_jenis_obat' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('obat');
        $this->dropTable('tindakan');
        $this->dropTable('pegawai');
        $this->dropTable('wilayah');
        $this->dropTable('jenis_obat');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250404_024009_create_tabel_data_master cannot be reverted.\n";

        return false;
    }
    */
}
