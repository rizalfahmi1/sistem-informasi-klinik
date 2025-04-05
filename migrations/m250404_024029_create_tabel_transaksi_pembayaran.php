<?php

use yii\db\Migration;

/**
 * Class m250404_024029_create_tabel_transaksi_pembayaran
 */
class m250404_024029_create_tabel_transaksi_pembayaran extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // Tabel Pembayaran
        $this->createTable('pembayaran', [
            'id' => $this->primaryKey(),
            'nomor_pembayaran' => $this->string(20)->notNull()->unique(),
            'id_pendaftaran' => $this->integer()->notNull(),
            'tanggal_pembayaran' => $this->integer(),
            'total_tagihan' => $this->decimal(12, 2)->notNull(),
            'jumlah_bayar' => $this->decimal(12, 2)->notNull(),
            'kembalian' => $this->decimal(12, 2)->defaultValue(0),
            'status_pembayaran' => $this->integer(),
            'catatan' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_pembayaran_pendaftaran',
            'pembayaran',
            'id_pendaftaran',
            'pendaftaran',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250404_024029_create_tabel_transaksi_pembayaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250404_024029_create_tabel_transaksi_pembayaran cannot be reverted.\n";

        return false;
    }
    */
}
