<?php

namespace app\modules\clientes\models;

use Yii;
use app\models\Usuarios;
use app\models\Departamentos;
use app\models\Municipios;
use app\modules\clientes\models\Clientes;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tbl_direcciones".
 *
 * @property int $id_direccion
 * @property int $id_cliente
 * @property string $contacto
 * @property string $telefono
 * @property string $direccion
 * @property int $id_departamento
 * @property int $id_municipio
 * @property int $principal
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 * @property int $estado
 *
 * @property Clientes $cliente
 * @property Departamentos $departamento
 * @property Municipios $municipio
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Direcciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_direcciones';
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
            [['id_cliente', 'contacto', 'telefono', 'direccion', 'id_departamento', 'id_municipio', 'principal', 'estado'], 'required'],
            [['id_cliente', 'id_departamento', 'id_municipio', 'principal', 'id_usuario_ing', 'id_usuario_mod', 'estado'], 'integer'],
            [['direccion'], 'string'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['contacto'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 15],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['id_cliente' => 'id_cliente']],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::class, 'targetAttribute' => ['id_departamento' => 'id_departamento']],
            [['id_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::class, 'targetAttribute' => ['id_municipio' => 'id_municipio']],
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
            'id_direccion' => 'Id',
            'id_cliente' => 'Cliente',
            'contacto' => 'Contacto',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'id_departamento' => 'Departamento',
            'id_municipio' => 'Municipio',
            'principal' => 'Principal',
            'fecha_ing' => 'Fecha de Ingreso',
            'id_usuario_ing' => 'Registrado por',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Modificado por',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::class, ['id_cliente' => 'id_cliente']);
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::class, ['id_departamento' => 'id_departamento']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipios::class, ['id_municipio' => 'id_municipio']);
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
