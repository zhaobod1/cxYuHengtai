/**
 * Created by apple on 2017/1/4.
 * 火一五信息科技有限公司
 * 联系方式:15288986891
 * QQ:3186355915
 * web:http://host.huo15.com
 * 日期: 2017/1/4
 */

mui.init();
function plusReady(){
  // 用户侧滑返回时关闭显示的图片
  plus.webview.currentWebview().addEventListener( "popGesture", function(e){
    if(e.type=="start"){
      closeImg();
    }
  }, false );
}

document.addEventListener('plusready',plusReady,false);

function getImage(){
  var cmr = plus.camera.getCamera();
  cmr.captureImage( function ( path ) {
    plus.gallery.save( path );
    outSet( "照片已成功保存到系统相册" );
  }, function ( e ) {
    outSet( "取消拍照" );
  }, {filename:"_doc/gallery/",index:1} );
}
function galleryImg() {
  // 从相册中选择图片
  outSet("从相册中选择图片:");
  plus.gallery.pick( function(path){
    outLine(path);
    //showImg( path );
    //createItem(path);
  }, function ( e ) {
    outSet( "取消选择图片" );
  }, {filter:"image"} );
}
function galleryImgs(){
  // 从相册中选择图片
  outSet("从相册中选择多张图片:");
  plus.gallery.pick( function(e){
    for(var i in e.files){
      outLine(e.files[i]);
    }
  }, function ( e ) {
    outSet( "取消选择图片" );
  },{filter:"image",multiple:true,system:false});
}
function galleryImgsMaximum(){
  // 从相册中选择图片
  outSet("从相册中选择多张图片(限定最多选择3张):");
  plus.gallery.pick( function(e){
    for(var i in e.files){
      outLine(e.files[i]);
    }
  }, function ( e ) {
    outSet( "取消选择图片" );
  },{filter:"image",multiple:true,maximum:3,system:false,onmaxed:function(){
    plus.nativeUI.alert('最多只能选择3张图片');
  }});// 最多选择3张图片
}
var lfs=null;// 保留上次选择图片列表
function galleryImgsSelected(){
  // 从相册中选择图片
  outSet("从相册中选择多张图片(限定最多选择3张):");
  plus.gallery.pick( function(e){
    lfs=e.files;
    for(var i in e.files){
      outLine(e.files[i]);
    }
  }, function ( e ) {
    outSet( "取消选择图片" );
  },{filter:"image",multiple:true,maximum:3,selected:lfs,system:false,onmaxed:function(){
    plus.nativeUI.alert('最多只能选择3张图片');
  }});// 最多选择3张图片
}
function showImg( url ){
  // 兼容以“file:”开头的情况
  if(0!=url.indexOf("file://")){
    url="file://"+url;
  }
  var _body_ = document.body;
  var _div_ = document.createElement("div");
  _div_.style.top="0px";
  _div_.style.left="0px";
  _div_.style.height="100%";
  _div_.style.width="100%";
  _div_.style.zIndex="99999";
  _div_.style.position="fixed";
  _div_.style.background="#ffffff";
  _div_.id="imgShow";
  _div_.onclick=closeImg;
  var _img_=document.createElement("img");
  _img_.src=url;
  _img_.style.width="100%";
  _body_.appendChild(_div_);
  _div_.appendChild(_img_);
}
function closeImg(){
  var trnode=document.getElementById("imgShow");
  trnode&&trnode.parentNode.removeChild(trnode);
}

var list=null,first=null;
document.addEventListener("DOMContentLoaded",function(){
  list=document.getElementById("list");
  first=document.getElementById("empty");
},false);
// 添加列表项
function createItem(path) {
  var li = document.createElement("li");
  li.className = "ditem";
  li.innerHTML = '<span class="iplay"><font class="aname"></font><br/><font class="ainf"></font></span>';
  li.setAttribute( "onclick", "displayMedia(this);" );
  list.insertBefore( li, first.nextSibling );
  var i = path.lastIndexOf("/");
  if(i<0){
    i = path.lastIndexOf("\\");
  }
  li.querySelector(".aname").innerText = path.substr(i+1);
  li.querySelector(".ainf").innerText = path;
  li.path = path;
  // 设置空项不可见
  first.style.display = "none";
}
// 清除列表记录
function cleanList() {
  list.innerHTML = '<li id="empty" class="ditem-empty">无记录</li>';
  empty = document.getElementById( "empty" );
  // 删除音频文件
  outSet( "清空选择照片记录：" );
}
// 返回后关闭图片显示
var _back=window.back;
window.back=function(){
  closeImg();
  _back();
};