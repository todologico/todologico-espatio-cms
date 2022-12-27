<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AAB_Bann1Controller;
use App\Http\Controllers\BBP_Prod1Controller;

use App\Http\Controllers\RXCP_Cate1Controller;
use App\Http\Controllers\RXCP_Prod1Controller;

use App\Http\Controllers\ZGFCP_Fami1Controller;
use App\Http\Controllers\ZGFCP_Cate1Controller;
use App\Http\Controllers\ZGFCP_Prod1Controller;

use App\Http\Controllers\CCC_Cont1Controller;


Route::get('/', function () { return view('welcome');});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {


    //Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    //dashboard home
    Route::get('/dashboard', function () { return redirect()->route('aab-bann1-list');})->name('dashboard');
    
    //----------------------------------------------------------
    // AAB-BANN1
    //----------------------------------------------------------

    //aab_bann1 list
    Route::get('/aab-bann1-list',[AAB_Bann1Controller::class,'get_AAB_Bann1_CR'])->name('aab-bann1-list');

    //-------------------------------
    
    //aab_bann1 insert
    Route::get('/aab-bann1-insert',[AAB_Bann1Controller::class,'insert_AAB_Bann1_CR'])->name('aab-bann1-insert');
    
    //aab_bann1 insert pro
    Route::post('/aab-bann1-insert-pro',[AAB_Bann1Controller::class,'insertPro_AAB_Bann1_CR'])->name('aab-bann1-insert-pro');

    //-------------------------------
    
    //aab_bann1 dataform update
    Route::get('/aab-bann1-update/{aab_bann1_id}/{aab_bann1_token}',[AAB_Bann1Controller::class,'update_AAB_Bann1_CR'])->where(['aab_bann1_id' => '[0-9]+'])->name('aab-bann1-update');

    //aab_bann1 data update pro
    Route::post('/aab-bann1-update-pro', [AAB_Bann1Controller::class, 'updatePro_AAB_Bann1_CR'])->name('aab-bann1-update-pro');

    //-------------------------------

    //aab_bann1 images update form
    Route::get('/aab-bann1-images-update/{aab_bann1_id}/{aab_bann1_token}',[AAB_Bann1Controller::class,'updateImages_AAB_Bann1_CR'])->where(['aab_bann1_id' => '[0-9]+'])->name('aab-bann1-images-update');

    //aab_bann1 images update pro
    Route::post('/aab-bann1-images-update-pro', [AAB_Bann1Controller::class, 'updateImagesPro_AAB_Bann1_CR'])->name('aab-bann1-images-update-pro');

    //aab_bann1 images delete pro
    Route::get('/aab-bann1-images-delete-pro/{aab_bann1_id}/{aab_bann1_token}/{image_number}',[AAB_Bann1Controller::class,'deleteImagesPro_AAB_Bann1_CR'])->where(['aab_bann1_id' => '[0-9]+'])->name('aab-bann1-images-delete-pro');

    //-------------------------------

    //aab_bann1 delete pro
    Route::get('/aab-bann1-delete/{aab_bann1_id}/{aab_bann1_token}', [AAB_Bann1Controller::class, 'deletePro_AAB_Bann1_CR'])->where(['aab_bann1_id' => '[0-9]+'])->name('aab-bann1-delete-pro');

    //aab_bann1 clone pro
    Route::get('/aab-bann1-clone/{aab_bann1_id}/{aab_bann1_token}', [AAB_Bann1Controller::class, 'clonePro_AAB_Bann1_CR'])->where(['aab_bann1_id' => '[0-9]+'])->name('aab-bann1-clone-pro');

    //--------------------------------

    //aab_bann1 order
    Route::get('/aab-bann1-ordenar',[AAB_Bann1Controller::class,'order_AAB_Bann1_CR'])->name('aab-bann1-order');

    //ANGULARJS: aab_bann1 order pro
    Route::post('/aab-bann1-order-pro', [AAB_Bann1Controller::class, 'orderPro_AAB_Bann1_CR'])->name('aab-bann1-order-pro');    

    //--------------------------------

    //ANGULARJS: aab_bann1 publish or hide pro
    Route::post('/aab-bann1-publish-pro', [AAB_Bann1Controller::class, 'publishPro_AAB_Bann1_CR'])->name('aab-bann1-publish-pro');
    

    //----------------------------------------------------------
    // BBP-PROD1
    //----------------------------------------------------------

    //bbp-prod1 list
    Route::get('/bbp-prod1-list',[BBP_Prod1Controller::class,'get_BBP_Prod1_CR'])->name('bbp-prod1-list');

    //search list
    Route::get('/bbp-prod1-search-list-pro',[BBP_Prod1Controller::class,'getSearch_BBP_Prod1_CR'])->name('bbp-prod1-search-list-pro');


    //-------------------------------
    
    //bbp-prod1 insert
    Route::get('/bbp-prod1-insert',[BBP_Prod1Controller::class,'insert_BBP_Prod1_CR'])->name('bbp-prod1-insert');
    
    //bbp-prod1 insert pro
    Route::post('/bbp-prod1-insert-pro',[BBP_Prod1Controller::class,'insertPro_BBP_Prod1_CR'])->name('bbp-prod1-insert-pro');

    //-------------------------------
    
    //bbp-prod1 dataform update
    Route::get('/bbp-prod1-update/{bbp_prod1_id}/{bbp_prod1_token}',[BBP_Prod1Controller::class,'update_BBP_Prod1_CR'])->where(['bbp_prod1_id' => '[0-9]+'])->name('bbp-prod1-update');

    //bbp-prod1 data update pro
    Route::post('/bbp-prod1-update-pro', [BBP_Prod1Controller::class, 'updatePro_BBP_Prod1_CR'])->name('bbp-prod1-update-pro');

    //-------------------------------

    //bbp-prod1 images update form
    Route::get('/bbp-prod1-images-update/{bbp_prod1_id}/{bbp_prod1_token}',[BBP_Prod1Controller::class,'updateImages_BBP_Prod1_CR'])->where(['bbp_prod1_id' => '[0-9]+'])->name('bbp-prod1-images-update');

    //bbp-prod1 images update pro
    Route::post('/bbp-prod1-images-update-pro', [BBP_Prod1Controller::class, 'updateImagesPro_BBP_Prod1_CR'])->name('bbp-prod1-images-update-pro');

    //bbp-prod1 images delete pro
    Route::get('/bbp-prod1-images-delete-pro/{bbp_prod1_id}/{bbp_prod1_token}/{image_number}',[BBP_Prod1Controller::class,'deleteImagesPro_BBP_Prod1_CR'])->where(['bbp_prod1_id' => '[0-9]+'])->name('bbp-prod1-images-delete-pro');

    //-------------------------------

    //bbp-prod1 delete pro
   Route::get('/bbp-prod1-delete/{bbp_prod1_id}/{bbp_prod1_token}', [BBP_Prod1Controller::class, 'deletePro_BBP_Prod1_CR'])->where(['bbp_prod1_id' => '[0-9]+'])->name('bbp-prod1-delete-pro');

    //bbp-prod1 clone pro
    Route::get('/bbp-prod1clone/{bbp_prod1_id}/{bbp_prod1_token}', [BBP_Prod1Controller::class, 'clonePro_BBP_Prod1_CR'])->where(['bbp_prod1_id' => '[0-9]+'])->name('bbp-prod1-clone-pro');

    //--------------------------------

    //bbp-prod1 order
    Route::get('/bbp-prod1-ordenar',[BBP_Prod1Controller::class,'order_BBP_Prod1_CR'])->name('bbp-prod1-order');

    //ANGULARJS: bbp-prod1 order pro
    Route::post('/bbp-prod1-order-pro', [BBP_Prod1Controller::class, 'orderPro_BBP_Prod1_CR'])->name('bbp-prod1-order-pro');    

    //--------------------------------

    //ANGULARJS: bbp-prod1 publish or hide pro
    Route::post('/bbp-prod1-publish-pro', [BBP_Prod1Controller::class, 'publishPro_BBP_Prod1_CR'])->name('bbp-prod1-publish-pro');


    //----------------------------------------------------------
    // RXCP-CATE1
    //----------------------------------------------------------

    //rxcp-cate1 list
    Route::get('/rxcp-cate1-list',[RXCP_Cate1Controller::class,'get_RXCP_Cate1_CR'])->name('rxcp-cate1-list');

    //-------------------------------
    
    //rxcp-cate1 insert
    Route::get('/rxcp-cate1-insert',[RXCP_Cate1Controller::class,'insert_RXCP_Cate1_CR'])->name('rxcp-cate1-insert');
    
    //rxcp-cate1 insert pro
    Route::post('/rxcp-cate1-insert-pro',[RXCP_Cate1Controller::class,'insertPro_RXCP_Cate1_CR'])->name('rxcp-cate1-insert-pro');

    //-------------------------------
    
    //rxcp-cate1 dataform update
    Route::get('/rxcp-cate1-update/{rxcp_cate1_id}/{rxcp_cate1_token}',[RXCP_Cate1Controller::class,'update_RXCP_Cate1_CR'])->where(['rxcp_cate1_id' => '[0-9]+'])->name('rxcp-cate1-update');

    //rxcp-cate1 data update pro
    Route::post('/rxcp-cate1-update-pro', [RXCP_Cate1Controller::class, 'updatePro_RXCP_Cate1_CR'])->name('rxcp-cate1.update.pro');

    //-------------------------------

    //rxcp-cate1 images update form
    Route::get('/rxcp-cate1-images-update/{rxcp_cate1_id}/{rxcp_cate1_token}',[RXCP_Cate1Controller::class,'updateImages_RXCP_Cate1_CR'])->where(['rxcp_cate1_id' => '[0-9]+'])->name('rxcp-cate1-images-update');

    //rxcp-cate1 images update pro
    Route::post('/rxcp-cate1-images-update-pro', [RXCP_Cate1Controller::class, 'updateImagesPro_RXCP_Cate1_CR'])->name('rxcp-cate1-images-update-pro');

    //rxcp-cate1 images delete pro
    Route::get('/rxcp-cate1-images-delete-pro/{rxcp_cate1_id}/{rxcp_cate1_token}/{image_number}',[RXCP_Cate1Controller::class,'deleteImagesPro_RXCP_Cate1_CR'])->where(['rxcp_cate1_id' => '[0-9]+'])->name('rxcp-cate1-images-delete-pro');

    //-------------------------------

    //rxcp-cate1 delete pro
   Route::get('/rxcp-cate1-delete/{rxcp_cate1_id}/{rxcp_cate1_token}', [RXCP_Cate1Controller::class, 'deletePro_RXCP_Cate1_CR'])->where(['rxcp_cate1_id' => '[0-9]+'])->name('rxcp-cate1-delete-pro');

    //rxcp-cate1 clone pro
    Route::get('/rxcp-cate1clone/{rxcp_cate1_id}/{rxcp_cate1_token}', [RXCP_Cate1Controller::class, 'clonePro_RXCP_Cate1_CR'])->where(['rxcp_cate1_id' => '[0-9]+'])->name('rxcp-cate1-clone-pro');

    //--------------------------------

    //rxcp-cate1 order
    Route::get('/rxcp-cate1-ordenar',[RXCP_Cate1Controller::class,'order_RXCP_Cate1_CR'])->name('rxcp-cate1-order');

    //ANGULARJS: rxcp-cate1 order pro
    Route::post('/rxcp-cate1-order-pro', [RXCP_Cate1Controller::class, 'orderPro_RXCP_Cate1_CR'])->name('rxcp-cate1-order-pro');    

    //--------------------------------

    //ANGULARJS: rxcp-cate1 publish or hide pro
    Route::post('/rxcp-cate1-publish-pro', [RXCP_Cate1Controller::class, 'publishPro_RXCP_Cate1_CR'])->name('rxcp-cate1-publish-pro');


    //----------------------------------------------------------
    // RXCP-PROD1
    //----------------------------------------------------------

    //rxcp-prod1 list
    Route::get('/rxcp-prod1-list',[RXCP_Prod1Controller::class,'get_RXCP_Prod1_CR'])->name('rxcp-prod1-list');
    
    //search list
    Route::get('/rxcp-prod1-search-list-pro',[RXCP_Prod1Controller::class,'getSearch_RXCP_Prod1_CR'])->name('rxcp-prod1-search-list-pro');
    
    // search link
    Route::get('/rxcp-prod1-search-link-pro/{rxcp_cate1_id}/{rxcp_cate1_token}',[RXCP_Prod1Controller::class,'getSearchLink_RXCP_Prod1_CR'])->name('rxcp-prod1-search-link-pro');

    //-------------------------------
    
    //rxcp-prod1 insert
    Route::get('/rxcp-prod1-insert',[RXCP_Prod1Controller::class,'insert_RXCP_Prod1_CR'])->name('rxcp-prod1-insert');
    
    //rxcp-prod1 insert pro
    Route::post('/rxcp-prod1-insert-pro',[RXCP_Prod1Controller::class,'insertPro_RXCP_Prod1_CR'])->name('rxcp-prod1-insert-pro');

    //-------------------------------
    
    //rxcp-prod1 dataform update
    Route::get('/rxcp-prod1-update/{rxcp_prod1_id}/{rxcp_prod1_token}',[RXCP_Prod1Controller::class,'update_RXCP_Prod1_CR'])->where(['rxcp_prod1_id' => '[0-9]+'])->name('rxcp-prod1-update');

    //rxcp-prod1 data update pro
    Route::post('/rxcp-prod1-update-pro', [RXCP_Prod1Controller::class, 'updatePro_RXCP_Prod1_CR'])->name('rxcp-prod1-update-pro');

    //-------------------------------

    //rxcp-prod1 images update form
    Route::get('/rxcp-prod1-images-update/{rxcp_prod1_id}/{rxcp_prod1_token}',[RXCP_Prod1Controller::class,'updateImages_RXCP_Prod1_CR'])->where(['rxcp_prod1_id' => '[0-9]+'])->name('rxcp-prod1-images-update');

    //rxcp-prod1 images update pro
    Route::post('/rxcp-prod1-images-update-pro', [RXCP_Prod1Controller::class, 'updateImagesPro_RXCP_Prod1_CR'])->name('rxcp-prod1-images-update-pro');

    //rxcp-prod1 images delete pro
    Route::get('/rxcp-prod1-images-delete-pro/{rxcp_prod1_id}/{rxcp_prod1_token}/{image_number}',[RXCP_Prod1Controller::class,'deleteImagesPro_RXCP_Prod1_CR'])->where(['rxcp_prod1_id' => '[0-9]+'])->name('rxcp-prod1-images-delete-pro');

    //-------------------------------

    //rxcp-prod1 delete pro
   Route::get('/rxcp-prod1-delete/{rxcp_prod1_id}/{rxcp_prod1_token}', [RXCP_Prod1Controller::class, 'deletePro_RXCP_Prod1_CR'])->where(['rxcp_prod1_id' => '[0-9]+'])->name('rxcp-prod1-delete-pro');

    //rxcp-prod1 clone pro
    Route::get('/rxcp-prod1clone/{rxcp_prod1_id}/{rxcp_prod1_token}', [RXCP_Prod1Controller::class, 'clonePro_RXCP_Prod1_CR'])->where(['rxcp_prod1_id' => '[0-9]+'])->name('rxcp-prod1-clone-pro');

    //--------------------------------

    //rxcp-prod1 order
    Route::get('/rxcp-prod1-ordenar',[RXCP_Prod1Controller::class,'order_RXCP_Prod1_CR'])->name('rxcp-prod1-order');

    //ANGULARJS: rxcp-prod1 order pro
    Route::post('/rxcp-prod1-order-pro', [RXCP_Prod1Controller::class, 'orderPro_RXCP_Prod1_CR'])->name('rxcp-prod1-order-pro');    

    //--------------------------------

    //ANGULARJS: rxcp-prod1 publish or hide pro
    Route::post('/rxcp-prod1-publish-pro', [RXCP_Prod1Controller::class, 'publishPro_RXCP_Prod1_CR'])->name('rxcp-prod1-publish-pro');


    //----------------------------------------------------------
    // ZGFCP-FAMI1
    //----------------------------------------------------------

    //zgfcp-fami1 list
    Route::get('/zgfcp-fami1-list',[ZGFCP_Fami1Controller::class,'get_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-list');

    //-------------------------------
    
    //zgfcp-fami1 insert
    Route::get('/zgfcp-fami1-insert',[ZGFCP_Fami1Controller::class,'insert_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-insert');
    
    //zgfcp-fami1 insert pro
    Route::post('/zgfcp-fami1-insert-pro',[ZGFCP_Fami1Controller::class,'insertPro_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-insert-pro');

    //-------------------------------
    
    //zgfcp-fami1 dataform update
    Route::get('/zgfcp-fami1-update/{zgfcp_fami1_id}/{zgfcp_fami1_token}',[ZGFCP_Fami1Controller::class,'update_ZGFCP_Fami1_CR'])->where(['zgfcp_fami1_id' => '[0-9]+'])->name('zgfcp-fami1-update');

    //zgfcp-fami1 data update pro
    Route::post('/zgfcp-fami1-update-pro', [ZGFCP_Fami1Controller::class, 'updatePro_ZGFCP_Fami1_CR'])->name('zgfcp-fami1.update.pro');

    //-------------------------------

    //zgfcp-fami1 images update form
    Route::get('/zgfcp-fami1-images-update/{zgfcp_fami1_id}/{zgfcp_fami1_token}',[ZGFCP_Fami1Controller::class,'updateImages_ZGFCP_Fami1_CR'])->where(['zgfcp_fami1_id' => '[0-9]+'])->name('zgfcp-fami1-images-update');

    //zgfcp-fami1 images update pro
    Route::post('/zgfcp-fami1-images-update-pro', [ZGFCP_Fami1Controller::class, 'updateImagesPro_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-images-update-pro');

    //zgfcp-fami1 images delete pro
    Route::get('/zgfcp-fami1-images-delete-pro/{zgfcp_fami1_id}/{zgfcp_fami1_token}/{image_number}',[ZGFCP_Fami1Controller::class,'deleteImagesPro_ZGFCP_Fami1_CR'])->where(['zgfcp_fami1_id' => '[0-9]+'])->name('zgfcp-fami1-images-delete-pro');

    //zgfcp-fami1 delete pro
   Route::get('/zgfcp-fami1-delete/{zgfcp_fami1_id}/{zgfcp_fami1_token}', [ZGFCP_Fami1Controller::class, 'deletePro_ZGFCP_Fami1_CR'])->where(['zgfcp_fami1_id' => '[0-9]+'])->name('zgfcp-fami1-delete-pro');

    //zgfcp-fami1 clone pro
    Route::get('/zgfcp-fami1clone/{zgfcp_fami1_id}/{zgfcp_fami1_token}', [ZGFCP_Fami1Controller::class, 'clonePro_ZGFCP_Fami1_CR'])->where(['zgfcp_fami1_id' => '[0-9]+'])->name('zgfcp-fami1-clone-pro');

    //--------------------------------

    //zgfcp-fami1 order
    Route::get('/zgfcp-fami1-ordenar',[ZGFCP_Fami1Controller::class,'order_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-order');

    //ANGULARJS: zgfcp-fami1 order pro
    Route::post('/zgfcp-fami1-order-pro', [ZGFCP_Fami1Controller::class, 'orderPro_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-order-pro');    

    //--------------------------------

    //ANGULARJS: zgfcp-fami1 publish or hide pro
    Route::post('/zgfcp-fami1-publish-pro', [ZGFCP_Fami1Controller::class, 'publishPro_ZGFCP_Fami1_CR'])->name('zgfcp-fami1-publish-pro');

    //----------------------------------------------------------
    // ZGFCP-CATE1
    //----------------------------------------------------------

    //zgfcp-cate1 list
    Route::get('/zgfcp-cate1-list',[ZGFCP_Cate1Controller::class,'get_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-list');

    //-------------------------------
    
    //zgfcp-cate1 insert
    Route::get('/zgfcp-cate1-insert',[ZGFCP_Cate1Controller::class,'insert_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-insert');
    
    //zgfcp-cate1 insert pro
    Route::post('/zgfcp-cate1-insert-pro',[ZGFCP_Cate1Controller::class,'insertPro_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-insert-pro');

    //-------------------------------
    
    //zgfcp-cate1 dataform update
    Route::get('/zgfcp-cate1-update/{zgfcp_cate1_id}/{zgfcp_cate1_token}',[ZGFCP_Cate1Controller::class,'update_ZGFCP_Cate1_CR'])->where(['zgfcp_cate1_id' => '[0-9]+'])->name('zgfcp-cate1-update');

    //zgfcp-cate1 data update pro
    Route::post('/zgfcp-cate1-update-pro', [ZGFCP_Cate1Controller::class, 'updatePro_ZGFCP_Cate1_CR'])->name('zgfcp-cate1.update.pro');

    //-------------------------------

    //zgfcp-cate1 images update form
    Route::get('/zgfcp-cate1-images-update/{zgfcp_cate1_id}/{zgfcp_cate1_token}',[ZGFCP_Cate1Controller::class,'updateImages_ZGFCP_Cate1_CR'])->where(['zgfcp_cate1_id' => '[0-9]+'])->name('zgfcp-cate1-images-update');

    //zgfcp-cate1 images update pro
    Route::post('/zgfcp-cate1-images-update-pro', [ZGFCP_Cate1Controller::class, 'updateImagesPro_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-images-update-pro');

    //zgfcp-cate1 images delete pro
    Route::get('/zgfcp-cate1-images-delete-pro/{zgfcp_cate1_id}/{zgfcp_cate1_token}/{image_number}',[ZGFCP_Cate1Controller::class,'deleteImagesPro_ZGFCP_Cate1_CR'])->where(['zgfcp_cate1_id' => '[0-9]+'])->name('zgfcp-cate1-images-delete-pro');

    //-------------------------------

    //zgfcp-cate1 delete pro
   Route::get('/zgfcp-cate1-delete/{zgfcp_cate1_id}/{zgfcp_cate1_token}', [ZGFCP_Cate1Controller::class, 'deletePro_ZGFCP_Cate1_CR'])->where(['zgfcp_cate1_id' => '[0-9]+'])->name('zgfcp-cate1-delete-pro');

    //zgfcp-cate1 clone pro
    Route::get('/zgfcp-cate1clone/{zgfcp_cate1_id}/{zgfcp_cate1_token}', [ZGFCP_Cate1Controller::class, 'clonePro_ZGFCP_Cate1_CR'])->where(['zgfcp_cate1_id' => '[0-9]+'])->name('zgfcp-cate1-clone-pro');

    //--------------------------------

    //zgfcp-cate1 order
    Route::get('/zgfcp-cate1-ordenar',[ZGFCP_Cate1Controller::class,'order_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-order');

    //ANGULARJS: zgfcp-cate1 order pro
    Route::post('/zgfcp-cate1-order-pro', [ZGFCP_Cate1Controller::class, 'orderPro_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-order-pro');    

    //--------------------------------

    //ANGULARJS: zgfcp-cate1 publish or hide pro
    Route::post('/zgfcp-cate1-publish-pro', [ZGFCP_Cate1Controller::class, 'publishPro_ZGFCP_Cate1_CR'])->name('zgfcp-cate1-publish-pro');

//----------------------------------------------------------
// ZGFCP-PROD1
//----------------------------------------------------------

//zgfcp-prod1 list
Route::get('/zgfcp-prod1-list',[ZGFCP_Prod1Controller::class,'get_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-list');

//search list text
Route::get('/zgfcp-prod1-search-list-pro',[ZGFCP_Prod1Controller::class,'getSearch_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-search-list-pro');

// search link by families
Route::get('/zgfcp-fami1-prod1-search-link-pro/{zgfcp_fami1_id}/{zgfcp_fami1_token}',[ZGFCP_Prod1Controller::class,'getSearchLinkxFami1_ZGFCP_Prod1_CR'])->name('zgfcp-fami1-prod1-search-link-pro');

// search link by categories
Route::get('/zgfcp-cate1-prod1-search-link-pro/{zgfcp_cate1_id}/{zgfcp_cate1_token}',[ZGFCP_Prod1Controller::class,'getSearchLinkxCate1_ZGFCP_Prod1_CR'])->name('zgfcp-cate1-prod1-search-link-pro');

//-------------------------------

//zgfcp-prod1 insert
Route::get('/zgfcp-prod1-insert',[ZGFCP_Prod1Controller::class,'insert_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-insert');

//zgfcp-prod1 insert pro
Route::post('/zgfcp-prod1-insert-pro',[ZGFCP_Prod1Controller::class,'insertPro_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-insert-pro');

//-------------------------------

//zgfcp-prod1 dataform update
Route::get('/zgfcp-prod1-update/{zgfcp_prod1_id}/{zgfcp_prod1_token}',[ZGFCP_Prod1Controller::class,'update_ZGFCP_Prod1_CR'])->where(['zgfcp_prod1_id' => '[0-9]+'])->name('zgfcp-prod1-update');

//zgfcp-prod1 data update pro
Route::post('/zgfcp-prod1-update-pro', [ZGFCP_Prod1Controller::class, 'updatePro_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-update-pro');

//-------------------------------

//zgfcp-prod1 images update form
Route::get('/zgfcp-prod1-images-update/{zgfcp_prod1_id}/{zgfcp_prod1_token}',[ZGFCP_Prod1Controller::class,'updateImages_ZGFCP_Prod1_CR'])->where(['zgfcp_prod1_id' => '[0-9]+'])->name('zgfcp-prod1-images-update');

//zgfcp-prod1 images update pro
Route::post('/zgfcp-prod1-images-update-pro', [ZGFCP_Prod1Controller::class, 'updateImagesPro_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-images-update-pro');

//zgfcp-prod1 images delete pro
Route::get('/zgfcp-prod1-images-delete-pro/{zgfcp_prod1_id}/{zgfcp_prod1_token}/{image_number}',[ZGFCP_Prod1Controller::class,'deleteImagesPro_ZGFCP_Prod1_CR'])->where(['zgfcp_prod1_id' => '[0-9]+'])->name('zgfcp-prod1-images-delete-pro');

//-------------------------------

//zgfcp-prod1 delete pro
Route::get('/zgfcp-prod1-delete/{zgfcp_prod1_id}/{zgfcp_prod1_token}', [ZGFCP_Prod1Controller::class, 'deletePro_ZGFCP_Prod1_CR'])->where(['zgfcp_prod1_id' => '[0-9]+'])->name('zgfcp-prod1-delete-pro');

//zgfcp-prod1 clone pro
Route::get('/zgfcp-prod1clone/{zgfcp_prod1_id}/{zgfcp_prod1_token}', [ZGFCP_Prod1Controller::class, 'clonePro_ZGFCP_Prod1_CR'])->where(['zgfcp_prod1_id' => '[0-9]+'])->name('zgfcp-prod1-clone-pro');

//--------------------------------

//zgfcp-prod1 order
Route::get('/zgfcp-prod1-ordenar',[ZGFCP_Prod1Controller::class,'order_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-order');

//ANGULARJS: zgfcp-prod1 order pro
Route::post('/zgfcp-prod1-order-pro', [ZGFCP_Prod1Controller::class, 'orderPro_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-order-pro');    

//--------------------------------

//ANGULARJS: zgfcp-prod1 publish or hide pro
Route::post('/zgfcp-prod1-publish-pro', [ZGFCP_Prod1Controller::class, 'publishPro_ZGFCP_Prod1_CR'])->name('zgfcp-prod1-publish-pro');


//----------------------------------------------------------
// CCC-CONT1
//----------------------------------------------------------

//ccc-cont1-list
Route::get('/ccc-cont1-list',[CCC_Cont1Controller::class,'get_CCC_Cont1_CR'])->name('ccc-cont1-list');

 //search list
 Route::get('/ccc-cont1-search-list-pro',[CCC_Cont1Controller::class,'getSearch_CCC_Cont1_CR'])->name('ccc-cont1-search-list-pro');



//ccc-cont1 delete pro
Route::get('/ccc-cont1-delete/{ccc_cont1_id}/{ccc_cont1_token}', [CCC_Cont1Controller::class, 'deletePro_CCC_Cont1_CR'])->where(['ccc_cont1_id' => '[0-9]+'])->name('ccc-cont1-delete-pro');



});
