<?php /* Template_ 2.2.7 2014/04/08 10:44:52 /www/jbsinttr8192_godo_co_kr/shop/data/skin_mobileV2/light/proc/quick_menu.htm 000013579 */ ?>
<script type="text/javascript">
$(function(){
	var
	$background = $("#background").click(function(){
		$goodsOrderLayer.trigger('delete');
	}),
	$goodsOrderLayer = $("#goods-order-layer").bind('delete', function(){
		$("#goods-desc-quick-menu").removeClass("hide");
		$(this).fadeOut("fast");
		$background.fadeOut("fast");
	}).bind('create', function(){
		$("#goods-desc-quick-menu").addClass("hide");
		var layerTopPosition = $(window).scrollTop() + 75;
		$goodsOrderLayer.css({
			"top" : layerTopPosition+"px"
		}),
		$(this).fadeIn("fast", function(){
			$background.css("height", $(document).height() +"px");
		});
		$background.css({
			"opacity" : "0.2",
			"display" : "block"
		}).fadeIn("fast");
	}),
	$goodsForm = $goodsOrderLayer.children("form").submit(function(){
		if (checkForm(this)) {
			if (this.ea.value < 1) {
				alert("������ 1���̻� �Է����ּ���");
				this.ea.focus();
				return false;
			}
			return true;
		}
		else {
			return false;
		}
	});
	$("#goods-desc-quick-menu .toggle-button").click(function(){
		$("#goods-desc-quick-menu .navigation").slideDown(100, function(){
			$("#goods-desc-quick-menu .toggle-button").addClass("active");
		});
	});
	$("body").click(function(){
		if($("#goods-desc-quick-menu .toggle-button").hasClass("active")) {
			$("#goods-desc-quick-menu .navigation").slideUp(100, function(){
				$("#goods-desc-quick-menu .toggle-button").removeClass("active");
			});
		}
		else {
			// Nothing to do
		}
	});
	$("#goods-desc-quick-menu .navigation .purchase").click(function(){
		if ("<?php echo $TPL_VAR["strprice"]?>".length > 0) {
			$("[id=goodsres-hide] .text_msg").text("���ݴ�ü���� ��ǰ�Դϴ�");
			$("[id=goodsres-hide]").fadeIn(300);
			setTimeout( function() {
				$("[id=goodsres-hide]").fadeOut(300);
			}, 1000);
			$("#goods-desc-quick-menu .toggle-button").trigger("click");
			return false;
		}
		var
		GOODSNO = "<?php echo $TPL_VAR["goodsno"]?>",
		ITEM_HTML = '<div class="origin-goods-order-layer-item"><span class="title"></span><span class="content"></span></div>';
		$("#checkout-button-area").attr("src", "../../shop/proc/NaverCheckout_Button.php?goodsno="+GOODSNO+"&device=MOBILE");
		$.ajax({
			"url" : "<?php echo $GLOBALS["mobileRootDir"]?>/proc/mAjaxAction.php",
			"type" : "post",
			"data" : {
				"mode" : "get_option",
				"goodsno" : GOODSNO
			},
			"dataType" : "json",
			"success" : function(option) {
				var $optionSelectItemList = $goodsForm.children(".option-select-item-list").html("");

				$goodsForm.find("[name=goodsno]").val(GOODSNO);

				// �и��� �ɼ��� ���ùڽ� ����
				if (option.combination != null) {
					if (option.type == "double") {
						if (option.list[0]) {
							var
							$optionRow1 = $(ITEM_HTML),
							$optionName1 = $optionRow1.find(".title"),
							$content1 = $optionRow1.find(".content"),
							$selectBox = $(document.createElement("select")).attr("required", "required").attr("name", "opt[]"),
							$option = $(document.createElement("option"));

							$optionName1.text(option.name[0]);
							$content1.append($selectBox);

							$selectBox.append($option.clone().text("�������ּ���").val(""));
							for (var index in option.list[0]) {
								var
								optionValue = option.list[0][index],
								optionText = optionValue,
								combination = option.combination[optionValue+"/"],
								$_option = $option.clone();
								if (!option.list[1] && combination) {
									optionText += " ("+combination.price+"��)";
									if (option.stockable == true && combination.stock < 1) {
										optionText += " [ǰ��]";
									}
								}
								$_option.text(optionText).val(optionValue)
								$selectBox.append($_option);
							}

							$optionRow1.append($optionName1).append($content1);
							$optionSelectItemList.append($optionRow1);

							if (option.list[1]) {
								var
								$optionRow2 = $(ITEM_HTML),
								$optionName2 = $optionRow2.find(".title"),
								$content2 = $optionRow2.find(".content"),
								$selectBox2 = $($selectBox.get(0).cloneNode());
								$selectBox.change(function(){
									$selectBox2.html("");
									if ($(this).val()) {
										$selectBox2.append($option.clone().text("�������ּ���").val(""));
									}
									else {
										$selectBox2.append($option.clone().text("1���ɼ��� ���� �������ּ���").val(""));
										return;
									}
									for (var index in option.list[1]) {
										var
										optionValue = option.list[1][index],
										optionText = optionValue,
										combination = option.combination[$selectBox.val()+"/"+optionValue],
										$_option = $option.clone();
										if (combination) {
											optionText += " ("+combination.price+"��)";
											if (option.stockable == true && combination.stock < 1) {
												optionText += " [ǰ��]";
												$_option.attr("disabled", "disabled");
											}
										}
										$_option.text(optionText).val(optionValue)
										$selectBox2.append($_option);
									}
								});
								$optionName2.text(option.name[1]);
								$content2.append($selectBox2);
								$selectBox2.append($option.clone().text("1���ɼ��� ���� �������ּ���").val(""));
								$optionRow2.append($optionName2).append($content2);
								$optionSelectItemList.append($optionRow2);
							}
						}
					}
					// ��ü�� �ɼ��� ���ùڽ� ����
					else {
						var
						$optionRow = $(ITEM_HTML),
						$optionName = $optionRow.find(".title"),
						$optionContent = $optionRow.find(".content"),
						$selectBox = $(document.createElement("select")).attr("required", "required").attr("name", "opt[]"),
						$option = $(document.createElement("option"));
						$optionName.text(option.name.join("/"));
						$selectBox.append($option.clone().text("�������ּ���").val(""));
						for (var index in option.combination) {
							var
							combination = option.combination[index],
							optionValue = combination.opt1+"|"+combination.opt2,
							optionText = index,
							$_option = $option.clone();
							optionText += " ("+combination.price+"��)";
							if (option.stockable == true && combination.stock < 1) {
								optionText += " [ǰ��]";
								$_option.attr("disabled", "disabled");
							}
							$_option.text(optionText).val(optionValue);
							$selectBox.append($_option);
						}
						$optionContent.append($selectBox);
						$optionRow.append($optionName).append($optionContent);
						$optionSelectItemList.append($optionRow);
					}
				}

				// �߰��ɼ� ����
				var _idx = 0;
				for (var step in option.addopt) {
					var
					$addRow = $(ITEM_HTML),
					$addName = $addRow.find(".title"),
					$addContent = $addRow.find(".content"),
					$selectBox = $(document.createElement("select")).attr("name", "addopt[]"),
					$option = $(document.createElement("option"));

					$addName.text(step);

					if (option.addoptreq[_idx++] == true) $selectBox.attr("required", "required");
					$selectBox.append($option.clone().text("�������ּ���").val(""));
					for (var index in option.addopt[step]) {
						var
						addOption = option.addopt[step][index],
						$_option = $option.clone(),
						addOptionText = addOption.opt;
						if (addOption.addprice > 0) addOptionText += " (+ "+addOption.addprice+"��)";
						$_option.text(addOptionText).val(addOption.sno+"^"+step+"^"+addOption.opt+"^"+addOption.addprice);
						$selectBox.append($_option);
					}
					$addContent.append($selectBox);

					$addRow.append($addName, $addContent);

					$optionSelectItemList.append($addRow);
				}

				// �Է¿ɼ� ����
				var _idx = 0;
				for (var step in option.addopt_inputable) {

					var v = option.addopt_inputable[step];
					var
					$addRow = $(ITEM_HTML),
					$addName = $addRow.find(".title"),
					$addContent = $addRow.find(".content"),
					$addInput = $(document.createElement("input")).attr({
						name: 'addopt_inputable[]',
						type: 'text',
						label: step,
						'option-value': v.sno + '^' + step + '^' + v.opt + '^' + v.addprice,
						maxlength : v.opt
					}).css({'width':'100%'}),
					$_addInput = $(document.createElement("input")).attr({
						name: '_addopt_inputable[]',
						type: 'hidden'
					});

					if (option.addopt_inputable_req[_idx++] == true) $addInput.attr({"required" : "required", "fld_esssential" : "fld_esssential"});

					$addName.text(step);

					$addContent.append($addInput).append($_addInput);
					$addRow.append($addName, $addContent);
					$optionSelectItemList.append($addRow);
				}

				// �����Է¶� ����
				var
				$eaRow = $(ITEM_HTML),
				$eaTitle = $eaRow.find(".title"),
				$eaContent = $eaRow.find(".content"),
				$eaInput = $(document.createElement("input")).attr({
					"type" : "text",
					"size" : "4",
					"name" : "ea",
					"value": parseInt(option.min_ea) ? option.min_ea : 1
				}).css({
					"text-align" : "right",
					"height" : "22px"
				}).change(function(){
					orderCntCalc($(this), $(this).val(), 'set');
				});
				$eaTitle.text("����");
				$eaContent.append($eaInput);
				$eaContent.append($(document.createElement("button")).attr("type", "button").addClass("cnt_minus_btn").text("-").click(function(){console.log(document.activeElement);
					orderCntCalc($eaInput, -1);
					return false;
				})).append($(document.createElement("button")).attr("type", "button").addClass("cnt_plus_btn").text("+").click(function(){
					orderCntCalc($eaInput, 1);
					return false;
				}));

				if (option.min_ea) {
					$eaInput.attr('min', option.min_ea);
				}

				if (option.max_ea) {
					$eaInput.attr('max', option.max_ea);
				}

				if (option.sales_unit) {
					$eaInput.attr('step', option.sales_unit);
				}

				$eaRow.append($eaTitle).append($eaContent);
				$optionSelectItemList.append($eaRow);

				$goodsOrderLayer.trigger('create');
			}
		});
	});
	$("#order-goods-btn").click(function(){
		$goodsForm.attr("action", "<?php echo $GLOBALS["mobileRootDir"]?>/ord/order.php");
		$goodsForm.find("[name=mode]").val("addItem");
		$goodsForm.submit();
		return false;
	});
	$("#checkout-button-area").bind("load", function(){
		var contentBody = this.contentWindow.document.body;
		$(contentBody).css({
			"margin" : "0",
			"padding" : "0"
		});
		if (contentBody.children.length) $(this).height($(contentBody).height()).css("margin-bottom", 25);
		else $(this).height(0).css("margin-bottom", 0);
	});
	$("#cart-goods-btn").click(function(){
		$goodsForm.find("[name=mode]").val("addCart");

		if (checkForm($goodsForm[0]) === false) return false;

		$.ajax({
			"type" : "post",
			"url" : "<?php echo $GLOBALS["mobileRootDir"]?>/goods/ajaxAction.php",
			"dataType" : "json",
			"data" : $goodsForm.serialize(),
			"success" : function(result)
			{
				$.ajax({
					"url" : "<?php echo $GLOBALS["mobileRootDir"]?>/proc/mAjaxAction.php",
					"type" : "post",
					"data" : {
						"mode" : "get_cart_item"
					},
					"cash" : false,
					"dataType" : "json",
					"success" : function(cartItem)
					{
						if (cartItem.quantity) {
							$("#cart-btn .cart-item-quantity").text(" ("+cartItem.quantity.toString()+")");
						}
					}
				});
				alert(result.msg);
				$goodsOrderLayer.trigger('delete');
			},
			"error" : function(xhr)
			{
				var n1 = xhr.responseText.indexOf("<script>"), n2 = xhr.responseText.indexOf("<\/script>");
				if (n1>0 && n2 >n1) {
					var errmsg = xhr.responseText.substring(n1, n2 + "<\/script>".length);
					ifrmHidden.document.write(errmsg);
				} else {
					alert('��ٱ��� �߰�����!\n�ٽ� �õ��Ͽ��ֽñ� �ٶ��ϴ�.');
				}
			}
		});
		return false;
	});
	$("#wish-goods-btn").click(function(){
		$goodsForm.find("[name=mode]").val('addWishlist');

		if (checkForm($goodsForm[0]) === false) return false;

		$.ajax({
			"type" : "post",
			"url" : "<?php echo $GLOBALS["mobileRootDir"]?>/goods/ajaxAction.php",
			"dataType" : "json",
			"data" : $goodsForm.serialize(),
			"success" : function(result)
			{
				alert(result.msg);
				$goodsOrderLayer.trigger('delete');
			},
			"error" : function(xhr)
			{
				var n1 = xhr.responseText.indexOf("<script>"), n2 = xhr.responseText.indexOf("<\/script>");
				if (n1>0 && n2 >n1) {
					var errmsg = xhr.responseText.substring(n1, n2 + "<\/script>".length);
					ifrmHidden.document.write(errmsg);
				} else {
					alert('�Ͻ����� ������ �߻��Ͽ����ϴ�.\n�ٽ� �õ��Ͽ��ֽñ� �ٶ��ϴ�.');
				}
			}
		});
		return false;
	});
	$('#cancel-goods-btn').click(function(){
		$goodsOrderLayer.trigger('delete');
		return false;
	});
});
function checkForm(form)
{
	var ret = chkForm(form);

	if (ret) {
		if (form.ea.value < 1) {
			alert("������ 1���̻� �Է����ּ���");
			form.ea.focus();
			return false;
		}

		// �Է¿ɼ� üũ �� ó��
		var v, tmp;

		$(form).find('input[name="addopt_inputable[]"]').each(function(idx, el) {

			el = $(el);
			v = '';

			if (el.val()) {
				tmp = el.attr('option-value').split('^');
				tmp[2] = el.val();
				v = tmp.join('^');
			}

			$(form).find('input[name="_addopt_inputable[]"]').eq(idx).val(v);
		});

		return true;
	}
	else {
		return false;
	}
}
</script>