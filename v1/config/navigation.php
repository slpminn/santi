<nav class="navbar navbar-expand-lg navbar-light bg-light bottomMargin10">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Setup
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/v1/setup/users/listofusers.php">Users</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
	  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 rightMargin10" type="submit">Search</button>
	  <ul class="navbar-nav mr-auto leftMargin10 rightMargin10">
		  <li class="nav-item dropdown">
			<img class="avatarImage rightMargin10" id="profileDropdown" src="/v1/assets/img/avatars/<?php print $_SESSION['userid'];?>.png" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
			<div class="dropdown-menu" aria-labelledby="profileDropdown">
			  <a class="dropdown-item" href="/v1/listofusers.php">Change Password</a>
			  <a class="dropdown-item" href="#">Change Name</a>
			  <a class="dropdown-item" href="#">Change Avatar</a>
			</div>
		  </li>
	  </ul>
	  <a class="nav-link leftMargin10" href="/v1/logout.php">Log Out</a>
    </form>
  </div>
</nav>