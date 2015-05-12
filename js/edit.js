;(function($, window, document, undefined) {
  $(function(){
    var $window = $(window);
    var $result = $("#result");
    var $div = $result.find(".editableDiv");
    var $previewDiv = $("#preview");
    var $previewDivBg = $("#previewShield");
    var $html = $("html");
		var $body = $("body");
    var $alledit = $("#alledit");
    var $allwrite = $("#allwrite");
    
    var $backbtn = $("#backbtn");
    
    $backbtn.click(function(e){
    	e.preventDefault();
    	history.back();
    	return false;
    });

    //プレビュー機能
    $div.find(".preview").on("click", function(){
      var $this = $(this);
      $previewDiv.empty();
      $previewDivBg.off("click.exit");

      //UI SHIELD
      var windowWidth  = window.innerWidth  || $(window).width();
      var windowHeight = window.innerHeight || $(window).height();

      var maxWidth = Math.max(windowWidth, $html.outerWidth(), $body.outerWidth(), $body.children().eq(0).outerWidth() );
      var maxHeight= Math.max(windowHeight, $html.outerHeight(), $body.outerHeight(), $body.children().eq(0).outerHeight() );

      $previewDivBg.css({width:maxWidth, height:maxHeight}).show();

      //$previewDiv.append('<p style="color: #f92672; background:#333; margin:0; padding:10px;">クリックすると閉じます</p>');
      var $iframe = $previewDiv.append('<iframe width="800" height="600" src="'+$this.data("url")+'"></iframe>');

      $previewDiv.show();
      var _top = $window.scrollTop();
      var _left = (windowWidth - 800) / 2;

      $previewDiv.css({
        top: _top,
        left: _left
      });

      $previewDivBg.on("click.exit", function(){
        $previewDiv.hide();
        $previewDivBg.hide();
      });

      return false;
    });

    // 編集機能
    $div.find(".edit").on("click", function(){
      var $editBtn = $(this);
      var $wrp = $editBtn.closest(".editableDiv");
      var $writeBtn = $wrp.find(".write");

      //編集用inputに表示切り替え
      $wrp.find(".editable").each(function(){
        var $node = $(this).find(".node");
        var $nodeInput = $(this).find(".nodeInput");
        $node.hide();
        $nodeInput.show();
        $editBtn.hide();
        $writeBtn.show();
      });
    });
    $div.find(".write").on("click", function(){
      var $writeBtn = $(this);
      var $wrp = $writeBtn.closest(".editableDiv");
      var $editBtn = $wrp.find(".edit");

      var sendData = {};
      $wrp.find(".nodeInput").each(function(){
        var $ipt = $(this).find("input");
        sendData[$ipt.data("name")] = $ipt.val();
      });
      sendData["dir"] = $wrp.data("dir");
      sendData["code"] = $wrp.data("code");
      //console.log(sendData);
      $.ajaxQueue({
        url: "write.php",
        type: "POST",
        dataType: "json",
        data: sendData,
        success: function(json) {
          //表示用テキストに切り替え
          $wrp.find(".editable").each(function(){
            var $node = $(this).find(".node");
            var $nodeInput = $(this).find(".nodeInput");
            $node.text($nodeInput.find("input").val());
            $node.show();
            $nodeInput.hide();
            $editBtn.show();
            $writeBtn.hide();
          });
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          if( XMLHttpRequest.status != 0 && XMLHttpRequest.readyState != 0 && XMLHttpRequest.readyState != 1 && XMLHttpRequest.readyState != 2 && XMLHttpRequest.readyState != 3 ){
  					alert("書き込み失敗");
            console.log(XMLHttpRequest,textStatus,errorThrown);
            //表示用テキストに切り替え
            $wrp.find(".editable").each(function(){
              var $node = $(this).find(".node");
              var $nodeInput = $(this).find(".nodeInput");
              $node.show();
              $nodeInput.hide();
              $editBtn.show();
              $writeBtn.hide();
            });
  				}
        }
      });


    });

    //一括編集
    $alledit.on("click", function(){
      $div.find(".edit").trigger("click");
    });

    $allwrite.on("click", function(){
      $div.find(".write:visible").trigger("click");
    });
  });
}(jQuery, this, this.document));
