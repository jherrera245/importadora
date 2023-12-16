<?php

namespace app\modules\compras\models;

use Yii;
use app\models\Usuarios;
use app\modules\compras\models\Proveedores;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tbl_compras".
 *
 * @property int $id_compra
 * @property string $codigo
 * @property int $num_factura
 * @property int $id_proveedor
 * @property int $tipo_compra
 * @property string $fecha
 * @property int $anulado
 * @property string|null $comentarios
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Proveedores $proveedor
 * @property DetCompras[] $DetCompras
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Compras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_compras';
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
            [['codigo', 'num_factura', 'id_proveedor', 'tipo_compra', 'fecha', 'estado'], 'required'],
            [['num_factura', 'id_proveedor', 'tipo_compra', 'anulado', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['fecha', 'fecha_ing', 'fecha_mod'], 'safe'],
            [['comentarios'], 'string'],
            [['codigo'], 'string', 'max' => 10],
            [['id_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::class, 'targetAttribute' => ['id_proveedor' => 'id_proveedor']],
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
            'id_compra' => 'Id',
            'codigo' => 'Código',
            'num_factura' => 'Número Factura',
            'id_proveedor' => 'Proveedor',
            'tipo_compra' => 'Tipo de Compra',
            'fecha' => 'Fecha',
            'anulado' => 'Anulado',
            'comentarios' => 'Comentarios',
            'fecha_ing' => 'Fecha de Ingreso',
            'id_usuario_ing' => 'Registrado por',
            'fecha_mod' => 'Fecha de Modificación',
            'id_usuario_mod' => 'Modificado por',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::class, ['id_proveedor' => 'id_proveedor']);
    }

    /**
     * Gets query for [[DetCompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetCompras()
    {
        return $this->hasMany(DetCompras::class, ['id_compra' => 'id_compra']);
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
