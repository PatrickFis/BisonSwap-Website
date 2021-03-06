<div class="container">
  	<div class="row">
	  	<div class="col-sm-9">
					 <img class="img-responsive" id="pic_1" alt="" title="" src="">
	  	</div>
	  	<div class="col-sm-3">
	  		<h3 id="item-name"></h3>
	  		<p><b>Description:<b></p>
	  		<p id="item-description"></p>
        <!-- Trigger the modal with a button -->
        <p><b>User's rating:</b></p>
        <p id="user-rating"></p>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Make Offer</button>

        <?php
          // echo '<a href="make_offer.php?KEY='.$_GET['key'].'">Make an offer</a>';
         ?>
	  	</div>
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Make an Offer</h4>
            </div>
            <div class="modal-body" id="item_list">
            </div>
            <p>Choose the item that you wish to trade. The item owner has 72 hours to accept your offer.
            You may extend your offers on the My Offers page.</p>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Trade this item</button>
            </div>
          </div>

        </div>
      </div>
  	</div>
</div>
