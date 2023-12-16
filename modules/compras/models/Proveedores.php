<?php

namespace app\modules\compras\models;

use app\models\Usuarios;
use app\models\Departamentos;
use app\models\Municipios;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use Yii;

/**
 * This is the model class for table "tbl_proveedores".
 *
 * @property int $id_proveedor
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $id_departamento
 * @property int $id_municipio
 * @property string $telefono
 * @property string $email
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_mod
 * @property int|null $fecha_mod
 * @property int $estado
 *
 * @property Departamentos $departamento
 * @property Municipios $municipio
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_proveedores';
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
            [['codigo', 'nombre', 'id_departamento', 'id_municipio', 'telefono', 'email', 'estado'], 'required'],
            [['descripcion'], 'string'],
            [['id_departamento', 'id_municipio', 'id_usuario_ing', 'id_usuario_mod', 'fecha_mod', 'estado'], 'integer'],
            [['fecha_ing'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 255],
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
            'id_proveedor' => 'Id',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'id_departamento' => 'Departamento',
            'id_municipio' => 'Municipio',
            'telefono' => 'Teléfono',
            'email' => 'Email',
            'id_usuario_ing' => 'Usuario Ingreso',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_mod' => 'Usuario Modificación',
            'fecha_mod' => 'Fecha Modificación',
            'estado' => 'Estado',
        ];
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
