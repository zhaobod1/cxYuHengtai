/**
 * Created by apple on 2017/1/4.
 * 火一五信息科技有限公司
 * 联系方式:15288986891
 * QQ:3186355915
 * web:http://host.huo15.com
 * 日期: 2017/1/4
 */
mui.init();
document.addEventListener("plusready",plusReady, false);
function plusReady() {

  var ws = plus.webview.currentWebview();

  // 用户侧滑返回时关闭显示的图片
  ws.addEventListener( "popGesture", function(e){
    if(e.type=="start"){
      closeImg();
    }
  }, false );

  var lfs=null;// 保留上次选择图片列表

}





function galleryImgsSelected() {
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

function closeImg(){
  var trnode=document.getElementById("imgShow");
  trnode&&trnode.parentNode.removeChild(trnode);
}