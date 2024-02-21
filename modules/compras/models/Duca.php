<?php

namespace app\modules\compras\models;

use Yii;
use app\models\Usuarios;
use app\modules\compras\models\Proveedores;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "tbl_duca".
 *
 * @property int $id_duca
 * @property int $no_correlativo
 * @property int $no_duca
 * @property string $fecha_aceptacion
 * @property string|null $nombre_transportista
 * @property string|null $modo_transporte
 * @property string|null $pais_procedencia
 * @property string|null $pais_destino
 * @property string|null $pais_exportacion
 * @property int $id_compra
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Compras $compra
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 * 

 */
class Duca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_duca';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute'=>'fecha_ing',
                'updatedAtAttribute'=>'fecha_mod',
                'value'=> date('Y-m-d H:i:s')
            ],
            [
                'class' =>BlameableBehavior::class,
                'createdByAttribute'=>'id_usuario_ing',
                'updatedByAttribute'=>'id_usuario_mod'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_correlativo', 'no_duca', 'fecha_aceptacion', 'id_compra', 'estado'], 'required'],
            [['no_correlativo', 'no_duca', 'id_compra', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['fecha_aceptacion', 'fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre_transportista'], 'string', 'max' => 150],
            [['modo_transporte', 'pais_procedencia', 'pais_destino', 'pais_exportacion'], 'string', 'max' => 100],
            [['id_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Compras::class, 'targetAttribute' => ['id_compra' => 'id_compra']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
            [['id_usuario_mod'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_mod' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_duca' => 'Id Duca',
            'no_correlativo' => 'No Correlativo',
            'no_duca' => 'No Duca',
            'fecha_aceptacion' => 'Fecha Aceptacion',
            'nombre_transportista' => 'Nombre Transportista',
            'modo_transporte' => 'Modo Transporte',
            'pais_procedencia' => 'Pais  Procedencia',
            'pais_destino' => 'Pais Destino',
            'pais_exportacion' => 'Pais  Exportacion',
            'id_compra' => 'Id Compra',
            'fecha_ing' => 'Fecha Ing',
            'id_usuario_ing' => 'Id Usuario Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario_mod' => 'Id Usuario Mod',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Compra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompra()
    {
        return $this->hasOne(Compras::class, ['id_compra' => 'id_compra']);
    }

    /**
     * Gets query for [[UsuarioIng]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIng()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_ing']);
    }

    /**
     * Gets query for [[UsuarioMod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioMod()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_mod']);
    }
}
