<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="{{ URL::to('/') }}">Notebook App</a>
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	   <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
	   <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
	      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
	         <a class="nav-link" href="{{ URL::to('/') }}">
	            <i class="fa fa-fw fa-dashboard"></i>
	            <span class="nav-link-text">Notes</span>
	         </a>
	      </li>
	      <hr>
	   <!--    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
	         <label class="custom-control-label" style="padding: 1em; color: black;">Notebook</label>
	      </li> -->
	      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		         <a class="nav-link">
		            <i class="fa fa-book"></i>
		            <span class="nav-link-text">Notebook</span>
		         </a>
		      </li>
	      @foreach($notebook_list as $notebook)
	      	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		         <a class="nav-link" href="{{ URL::to('notebook/'.$notebook -> id.'') }}">
		            <i class="fa fa-square"></i>
		            <span class="nav-link-text">{{ $notebook -> nb_name }}</span>
		         </a>
		      </li>
	      @endforeach
	      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
	         <a class="nav-link" data-toggle="modal" data-target="#newNotebook">
	            <i class="fa fa-plus"></i>
	            <span class="nav-link-text">Create New Notebook</span>
	         </a>
	      </li>
	      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
	         <a class="nav-link" href="{{ URL::to('item/') }}">
	            <i class="fa fa-fw fa-cubes"></i>
	            <span class="nav-link-text">Items</span>
	         </a>
	      </li>
	     	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
	         <a class="nav-link" href="#">
	            <i class="fa fa-fw fa-link"></i>
	            <span class="nav-link-text">Link</span>
	         </a>
	      </li>
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
				<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
					<i class="fa fa-fw fa-sitemap"></i>
					<span class="nav-link-text">Menu Levels</span>
				</a>
				<ul class="sidenav-second-level collapse" id="collapseMulti">
					<li>
						<a href="#">Second Level Item</a>
					</li>
					<li>
						<a href="#">Second Level Item</a>
					</li>
					<li>
						<a href="#">Second Level Item</a>
					</li>
				</ul>
			</li>
	   </ul>
	   <ul class="navbar-nav sidenav-toggler">
	      <li class="nav-item">
	         <a class="nav-link text-center" id="sidenavToggler">
	            <i class="fa fa-fw fa-angle-left"></i>
	         </a>
	      </li>
	   </ul>
	</div>
</nav>