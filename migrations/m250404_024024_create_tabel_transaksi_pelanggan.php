<?php

use yii\db\Migration;

/**
 * Class m250404_024024_create_tabel_transaksi_pelanggan
 */
class m250404_024024_create_tabel_transaksi_pelanggan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pasien', [
            'id' => $this->primaryKey(),
            'nomor_rekam_medis' => $this->string(20)->notNull()->unique(),
            'nik' => $this->string(20)->unique(),
            'nama_lengkap' => $this->string(100)->notNull(),
            'jenis_kelamin' => $this->integer()->notNull(),
            'tanggal_lahir' => $this->integer()->notNull(),
            'alamat' => $this->text()->notNull(),
            'nomor_telepon' => $this->string(20)->notNull(),
            'golongan_darah' => "ENUM('A','B','AB','O','Tidak Tahu')",
            'informasi_alergi' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // Tabel Pendaftaran
        $this->createTable('pendaftaran', [
            'id' => $this->primaryKey(),
            'nomor_pendaftaran' => $this->string(20)->notNull()->unique(),
            'id_pasien' => $this->integer()->notNull(),
            'tanggal_pendaftaran' => $this->dateTime()->notNull(),
            'id_dokter' => $this->integer(),
            'keluhan' => $this->text()->notNull(),
            'status_pendaftaran' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_pendaftaran_pasien',
            'pendaftaran',
            'id_pasien',
            'pasien',
            'id'
        );

        $this->addForeignKey(
            'fk_pendaftaran_dokter',
            'pendaftaran',
            'id_dokter',
            'pegawai',
            'id'
        );

        // Tabel Rekam Medis
        $this->createTable('rekam_medis', [
            'id' => $this->primaryKey(),
            'id_pendaftaran' => $this->integer()->notNull(),
            'diagnosa' => $this->text(),
            'catatan' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_rekam_medis_pendaftaran',
            'rekam_medis',
            'id_pendaftaran',
            'pendaftaran',
            'id'
        );

        // Tabel Tindakan Medis
        $this->createTable('tindakan_medis', [
            'id' => $this->primaryKey(),
            'id_rekam_medis' => $this->integer()->notNull(),
            'id_tindakan' => $this->integer()->notNull(),
            'jumlah' => $this->integer()->defaultValue(1),
            'biaya' => $this->decimal(12, 2)->notNull(),
            'catatan' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_tindakan_medis_rekam_medis',
            'tindakan_medis',
            'id_rekam_medis',
            'rekam_medis',
            'id'
        );

        $this->addForeignKey(
            'fk_tindakan_medis_tindakan',
            'tindakan_medis',
            'id_tindakan',
            'tindakan',
            'id'
        );

        // Tabel Resep Obat
        $this->createTable('resep_obat', [
            'id' => $this->primaryKey(),
            'id_rekam_medis' => $this->integer()->notNull(),
            'id_obat' => $this->integer()->notNull(),
            'jumlah' => $this->integer()->notNull(),
            'harga' => $this->decimal(12, 2)->notNull(),
            'dosis' => $this->text(),
            'catatan' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_resep_rekam_medis',
            'resep_obat',
            'id_rekam_medis',
            'rekam_medis',
            'id'
        );

        $this->addForeignKey(
            'fk_resep_obat',
            'resep_obat',
            'id_obat',
            'obat',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('resep_obat');
        $this->dropTable('tindakan_medis');
        $this->dropTable('rekam_medis');
        $this->dropTable('pendaftaran');
        $this->dropTable('pasien');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250404_024024_create_tabel_transaksi_pelanggan cannot be reverted.\n";

        return false;
    }
    */
}
