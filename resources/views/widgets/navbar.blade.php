<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e5e5e5;
}

.topnav a {
  float: left;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
}

.topnav a.active {
  background-color: #f2f2f2;
}
</style>
<div class="topnav">
  <a href="javascript:void" onclick="Logout.logout()">Logout</a>
  <a href="/">See all</a>
  <a href="/friends">See friends</a>
  <a href="/info">My info</a>

</div> 
<script src="js/components/auth/logout.js"></script>
