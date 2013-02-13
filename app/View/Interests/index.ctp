<script type="text/javascript">
ddaccordion.init({
 headerclass: "expandable", //Shared CSS class name of headers group that are expandable
 contentclass: "categoryitems", //Shared CSS class name of contents group
 revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
 collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
 defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
 animatedefault: false, //Should contents open by default be animated into view?
 persiststate: true, //persist state of opened contents within browser session?
 toggleclass: ["selected", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
 togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
 animatespeed: "fast", //speed of animation: "fast", "normal", or "slow"
 oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
  //do nothing
 },
 onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
  //do nothing
 }
})
</script>

<script type="text/javascript">
        $(document).ready(function(){
                $(".popup1").colorbox({width:"776px", height:"950px", background:"none", iframe:true});
                //Example of preserving a JavaScript event for inline calls.
                $("#click").click(function(){ 
                        $('#click').css({"background-color":"#000", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                        return false;
                });
        });

</script>

<!--Start middle Container-->
<div id="middleCntr">
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt" style="padding-top:11px;">
					<?php echo $userFullName . '\'s Alpha Interests'; ?>
				</div>
			</div>
		</div>
		<div class="cntrCntr">

			<!-- Start of Profile Left bar -->
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image_0'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>
			</div>
			<!-- End of Profile Left bar -->

			<!-- Start rightCntr -->
			<div id="rightCntr">

				<div id="interests_list" style="display: none">
					<h2>Choose Interest <span></span> <span>close</span></h2>
					<div>
						<ul class="my-interest">
							<?php foreach ($areas as $key => $area): ?>
								<?php foreach ($area['ChildArea'] as $child): ?>
									<?php
										// Make sure it's not in my current interests
										$result = Set::extract('/./Area[id=' . $child['id'] . ']', $interests);
										$parentName = getParentName($child['parent_id'], $area);
									?>
									<?php if (empty($result)): ?>
										<?php 
											$parentId = $areas[$key]['Area']['id'];
										?>
										<li 
										    class="parent-<?php echo $parentId; ?> child-<?php echo $child['id']; ?>"
										>
											<?php 
												$img = 'polaroid_tmp.jpg';
												if (!empty($child['image'])) {
													$img = $child['image'];
												}
											?>
											<div>
											  <div style="background-image: url(<?php echo Configure::read('IMG_URL'); ?>interests_icons/<?php echo $img; ?>);"></div>
											  <span><?php echo $parentName . ' - ' . $child['name']; ?></span>
											  <?php
												echo $this->Html->image('checkmark._16_green.png', array(
													'style' => 'display: none', 
													'class' => 'move-to-do', 
													'title' => 'Add to those dreams I do'
												));
												echo $this->Html->image('delete.png', array(
													'style' => 'display: none',
													'class' => 'delete',
													'title' => ''
												));
											?>
											</div>
											<?php
												$img = 'polaroid_tmp.jpg';
											?>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endforeach; ?>
						</ul>
					</div>
					<span></span>
				</div>

				<div id="interests-wrapper">

					<!-- Start rgtCntrleft -->
					<div id="rgtCntrleft">
	
						<?php foreach ($areas as $key => $area): ?>
							<?php
								$blocks = array(
									0 => 'interest_i_do_' . $area['Area']['id'],
									1 => 'interest_i_dream_' . $area['Area']['id'],
									2 => 'interest_i_dont_' . $area['Area']['id']
								);
								$iDo    = 'interest_i_do_' . $area['Area']['id'];
								$iDream = 'interest_i_dream_' . $area['Area']['id'];
								$iDont  = 'interest_i_dont_' . $area['Area']['id'];

								$this->start($blocks[0]);
								$this->end();
	
								$this->start($blocks[1]);
								$this->end();

								$this->start($blocks[2]);
								$this->end();

								foreach ($interests as $rec) {
									if ($rec['Interest']['mainarea'] == $area['Area']['id']) {
										$this->append( $blocks[$rec['Interest']['status']] );
											if (!empty($rec['Area']['image'])) {
												$img = $rec['Area']['image'];
											}
											$parentName = getParentName($rec['Area']['parent_id'], $area);
											$parentId = $areas[$key]['Area']['id'];
											echo '<li class="parent-' . $parentId . ' child-' . $rec['Area']['id'] . '" >';
											echo '  <div>';
											echo '    <div style="background-image: url(' . Configure::read('IMG_URL') .'interests_icons/' . $img .');"></div>';
											echo '    <span>'.  $parentName . ' - ' . $rec['Area']['name'] . '</span>';
											echo $this->Html->image('checkmark._16_green.png', array(
												'style' => 'display: none',
												'class' => 'move-to-do',
												'title' => 'Add to those dreams I do'
											));
											echo $this->Html->image('delete.png', array(
												'style' => 'display: none',
												'class' => 'delete'
											));
											echo '  </div>';
											echo '</li>';
										$this->end();
										$img = 'polaroid_tmp.jpg';
									}
								}
							?>
	
							<div class="expandable">
								<h2><?php echo $area['Area']['name']; ?></h2>
							</div>
							<div class="categoryitems">
								<h4 class="area-header area-<?php echo $area['Area']['id']; ?>-0">Those I've lived <span>add</span></h4>
								<ul class="my-interest interest-i-do">
									<?php echo $this->fetch($blocks[0]); ?>
								</ul>

								<h4 class="area-header area-<?php echo $area['Area']['id']; ?>-1">Those I dream of doing<span>add</span></h4>
								<ul class="my-interest interest-i-dream">
									<?php echo $this->fetch($blocks[1]); ?>
								</ul>

								<h4 class="area-header area-<?php echo $area['Area']['id']; ?>-2">Those I do not wish to do<span>add</span></h4>
								<ul class="my-interest interest-i-dont">
									<?php echo $this->fetch($blocks[2]); ?>
								</ul>
							</div>
	
						<?php endforeach; ?>
	
					</div>
					<!-- Start rgtCntrleft -->

				</div>

				<!-- Start rgtCntrright -->
				<div id="rgtCntrright">
					<?php echo $this->element('Interests/interest_rightbar'); ?>
					<div class="clr"></div>	
					</div>
				<!-- End rgtCntrright -->

			</div>
			<!-- End rightCntr -->
		</div>
		<div class="clr"></div>
	</div>
</div>

<?php

echo $this->Form->create('Interest', array(
	'url' => array(),
	'id' => 'interestForm'
));
echo $this->Form->hidden('Interest.mainarea');
echo $this->Form->hidden('Interest.area_id');
echo $this->Form->hidden('Interest.status');
echo $this->Form->end();

?>

<script type="text/javascript">
	jQuery(function($){
		$.fn.center = function () {
			this.css('position', 'absolute');
			this.css('top', Math.max(0, (($(window).height() - this.outerHeight()) / 2) + 
			                              $(window).scrollTop()) + 'px');
			this.css('left', Math.max(0, (($(window).width() - this.outerWidth()) / 2) + 
			                              $(window).scrollLeft()) + 'px');
			return this;
		}

		// Pre-query elements.
		var interests = $('#interests_list');
		var interestMainarea = $('#InterestMainarea');
		var interestAreaId = $('#InterestAreaId');
		var interestStatus = $('#InterestStatus');
		var msg = interests.find('h2 > span:first-child');
		var interestForm = $('#interestForm');
		var interestMsg = $('#interests_list > span');

		$('h4.area-header > span:last-child').click(function(){
			interests.center().show();
			interestMsg.html('');
			var match = $(this).parent().attr('class').match(/area\-([0-9]+)\-([0,1,2])/);
			if (match != null) {
				interestStatus.val(match[2]);

				if (match[2] == 0) {
					$(msg).html('you have lived');
				} else if (match[2] == 1) {
					$(msg).html('you dream to do');
				} else {
					$(msg).html('you do not wish to do');
				}

				interests.find('ul li:visible').hide();
				interests.find('ul li.parent-' + match[1]).show();
			}
		});

		interests.children('h2').children('span').click(function(){
			interests.hide();
		});

		// Save new interest
		var bindSaveNewInterest = function(){
			var match = $(this).parent().parent().attr('class').match(/parent\-([0-9]+)\schild\-([0-9]+)/);

			//console.log($(this).parent().parent());
			interestMainarea.val(match[1]);
			interestAreaId.val(match[2]);

			$.ajax({
				url:  '<?php echo $this->base; ?>/interests/change',
				type: 'POST',
				data: interestForm.serialize(),
				success: function(data) {
				}
			});
			//console.log(match); // TODO: Remove this for production mode

			// Move interest icon to user interests
			var statusId = interestStatus.val();
			interestMsg.html($(this).next().html() + ' has been added'); // Set message when adding new interest
			$(this).off('click');
			$('h4.area-' + match[1] + '-' + statusId).next().append($(this).parent().parent());
			addDelete();

			if (statusId == 1) {
				//console.log($(this));
				addAccomplished();
				$(this).parent().find('img.move-to-do').click(bindUpdateToThoseIdo);
			}
		};
		interests.find('ul li > div > div').click(bindSaveNewInterest);

		$('.expandable > h2').click(function(){
			interests.hide();
		});

		// Bind delete hover icon.
		function addDelete() {
			var interestItem = $('.categoryitems .my-interest li');
			interestItem.each(function(){
				var areaCat = $(this).parent().prev().attr('class').match(/area\-([0-9]+)\-([0,1,2])/)[2];
				if (areaCat == 0) {
					var msgTitle = 'Remove from those I\'ve lived';
				} else {
					var msgTitle = 'Remove from those I dream to do';
				}
				//console.log(interestItem);
				//$(this).hover(function(){
					$(this).find('img.delete').show();
					$(this).find('img.delete').attr('title', msgTitle);
				//},function(){
				//	$(this).find('img.delete').hide();
				//	$(this).find('img.delete').attr('title', msgTitle);
				//});
			});
			
		}
		addDelete();

		// Bind accomplished hover icon.
		function addAccomplished() {
			//$('.categoryitems .interest-i-dream li').hover(function(){
			//	$(this).find('img.move-to-do').show();
			//},function(){
			//	$(this).find('img.move-to-do').hide();
			//});
			$('.categoryitems .interest-i-dream li').find('img.move-to-do').show();
		}
		addAccomplished();

		var bindDeleteButton = function(){
			var matches = $(this).parent().parent().attr('class').match(/parent\-([0-9]+)\schild\-([0-9]+)/);

			//console.log($(this).parent().parent().children('div'));
			if (confirm('Remove ' + $(this).parent().find('span').html() + '?')) {
				interestMainarea.val(matches[1]);
				interestAreaId.val(matches[2]);
				$.ajax({
					url:  '<?php echo $this->base; ?>/interests/delete',
					type: 'POST',
					data: interestForm.serialize(),
					success: function(data) {
					},
					complete:function(){
					}
				});

				// Move user interest to interest list
				$(this).parent().parent().find('img.delete, img.move-to-do').hide();
				//console.log($(this));
				$(this).parent().children('div').click(bindSaveNewInterest);
				$('#interests_list .my-interest').append(
					$(this).parent().parent()
				);
			}
		};
		$('.my-interest li img.delete').click(bindDeleteButton);

		var bindUpdateToThoseIdo = function(){
			var matches = $(this).parent().parent().attr('class').match(/parent\-([0-9]+)\schild\-([0-9]+)/);

			if (confirm('Move ' + $(this).parent().find('div').html() + ' to dreams I\'ve lived?')) {
				interestMainarea.val(matches[1]);
				interestAreaId.val(matches[2]);
				interestStatus.val('0');
				$.ajax({
					url:  '<?php echo $this->base; ?>/interests/change',
					type: 'POST',
					data: interestForm.serialize(),
					success: function(data) {
					}
				});
				//$(this).parent().parent().unbind('hover').hover(function(){
					$(this).parent().parent().find('img.move-to-do').hide();
					$(this).parent().parent().find('img.delete').show();
				//},function(){
				//	$(this).find('img.delete').hide();
				//});
				$(this).parent().parent().parent().parent().find('ul:nth-of-type(1)').append(
					$(this).parent().parent()
				);
			}
		};
		$('.interest-i-dream li img:nth-of-type(1)').click(bindUpdateToThoseIdo);

		
	});
</script>

<?php 

function getParentName($parentId, $area)
{
	if ($area['Area']['id'] == $parentId) {
		return $area['Area']['name'];
	} else {
		foreach ($area['ChildArea'] as $child) {
			if ($child['id'] == $parentId) {
				return $child['name'];
				break;
			}
		}
	}
}

?>