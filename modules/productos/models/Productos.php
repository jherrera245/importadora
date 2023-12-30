<?php

namespace app\modules\productos\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\models\Usuarios;
use Yii;


/**
 * This is the model class for table "tbl_productos".
 *
 * @property int $id_producto
 * @property string $nombre
 * @property string $sku
 * @property string|null $descripcion
 * @property float $precio
 * @property int $id_categoria
 * @property int $id_sub_categoria
 * @property int $id_marca
 * @property int|null $is_car
 * @property string|null $pais_procedencia
 * @property string|null $chasis_grabado
 * @property string|null $vin
 * @property int $year
 * @property string $tipo_combustible
 * @property int $id_condicion
 * @property float|null $dai
 * @property float|null $iva
 * @property float|null $apm
 * @property float|null $vts
 * @property float|null $its
 * @property float|null $aiv
 * @property float|null $opm
 * @property int $estado
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 *
 * @property Categorias $categoria
 * @property Marcas $marca
 * @property SubCategorias $subCategoria
 * @property CondicionProducto $CondicionProducto
 * @property DetCompras[] $DetCompras
 * @property DetOrdenes[] $DetOrdenes
 * @property Inventario[] $Inventarios
 * @property Kardex[] $Kardexes
 * @property ProductosImagenes[] $ProductosImagenes
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos';
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
            [['nombre', 'sku', 'precio', 'id_categoria', 'id_sub_categoria', 'id_marca', 'year', 'id_condicion', 'estado'], 'required'],
            [['descripcion'], 'string'],
            [['precio', 'iva'], 'number'],
            [['id_categoria', 'id_sub_categoria', 'id_marca', 'is_car', 'year', 'id_condicion', 'estado', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre', 'sku', 'pais_procedencia', 'chasis_grabado'], 'string', 'max' => 100],
            [['vin'], 'string', 'max' => 17],
            [['tipo_combustible'], 'string', 'max' => 1],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_marca'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::class, 'targetAttribute' => ['id_marca' => 'id_marca']],
            [['id_sub_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategorias::class, 'targetAttribute' => ['id_sub_categoria' => 'id_sub_categoria']],
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
            'id_producto' => 'ID',
            'nombre' => 'Nombre',
            'sku' => 'SKU',
            'descripcion' => 'Descripción',
            'precio' => 'Precio',
            'id_categoria' => 'Categoria',
            'id_sub_categoria' => 'Subcategoria',
            'id_marca' => 'Marca',
            'is_car' => 'Carro',
            'pais_procedencia' => 'Pais Procedencia',
            'chasis_grabado' => 'Chasis Grabado',
            'vin' => 'VIN',
            'year' => 'Año',
            'tipo_combustible' => 'Tipo Combustible',
            'id_condicion' => 'Condición',
            'iva' => 'IVA',
            'estado' => 'Estado',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_ing' => 'Ingresado por',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Modificado por',
        ];
    }

    public static function getRutaProductos(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getRutaUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getThumbnails($id, $principal)
    {
        $imagenes = ProductosImagenes::find()->where(['id_producto'=>$id, 'principal'=>$principal])->all();
        $preview = [];

        foreach ($imagenes as $imagen) {
            $preview[] = [
                'title' => $imagen->imagen,
                'url' => self::getRutaUrl(true)."{$id}/{$imagen->imagen}",
                'src' => self::getRutaUrl(true)."{$id}/thumbnail/{$imagen->imagen}",
                'options' => ['title' => $imagen->imagen]
            ];
        }

        return $preview;
    }

    public static function getImagenPrincipal($id, $principal){
        $imagen = ProductosImagenes::find()->where(['id_producto'=>$id, 'principal'=>$principal])->one();

        if ($imagen) {
            return self::getRutaUrl(true)."{$id}/thumbnail/{$imagen->imagen}";
        }

        return self::getRutaUrl(true)."no_imagen.jpg";
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Marca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marcas::class, ['id_marca' => 'id_marca']);
    }

    /**
     * Gets query for [[SubCategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoria()
    {
        return $this->hasOne(SubCategorias::class, ['id_sub_categoria' => 'id_sub_categoria']);
    }

    /**
     * Gets query for [[CondicionProducto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionProducto()
    {
        return $this->hasOne(CondicionProducto::class, ['id_condicion' => 'id_condicion']);
    }

    /**
     * Gets query for [[DetCompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetCompras()
    {
        return $this->hasMany(DetCompras::class, ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[DetOrdenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetOrdenes()
    {
        return $this->hasMany(DetOrdenes::class, ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[Inventarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::class, ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[Kardexes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKardexes()
    {
        return $this->hasMany(Kardex::class, ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[ProductosImagenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosImagenes()
    {
        return $this->hasMany(ProductosImagenes::class, ['id_producto' => 'id_producto']);
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
