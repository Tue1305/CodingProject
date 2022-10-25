<%@page import="com.mycompany.myjsp.User"%>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/functions" prefix = "fn" %>
<%@page import="com.mycompany.myjsp.UserDao,com.mycompany.myjsp.*,java.util.*"%>  
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>  
<!DOCTYPE html>  

<html>  
    <head>  

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="popup.css"> 
        <link rel="stylesheet" href="button.css"> 
        <title>View Users</title>  
        <script>
            function myFunction() {
                document.getElementById("testform").submit();
            }
            function permission(id, name) {

                if (confirm('Are you sure you want to delete this USER: ' + name + ' ID: ' + id + ' from the database?')) {
                    // Save it!
                    //document.getElementById("testform").submit();

                    console.log('Thing was deleted from the database.');
                    return true;
                    alert('Thing was deleted from the database.');
                } else {
                    // Do nothing!
                    console.log('Thing was not deleted from the database.');
                    return false;
                    alert('Thing was not deleted from the database.');
                }
            }
            function popup(id, picture) {
//                alert(picture);
                var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg"+id);
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
//                img.onclick = function () {
                    modal.style.display = "block";
                    modalImg.src = img.src;
                    captionText.innerHTML = this.alt;
//                }

// Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
                span.onclick = function () {
                    modal.style.display = "none";
                }
                return false;
            }
            $(function () {

                $("#popup").dialog({
                    autoOpen: false,
                    modal: true
                });

                $(".modal").on("click", function (e) {
                    e.preventDefault();
                    $("#myModal").dialog("open");
                });

            });
        </script>
        <style>
            .myclass {
                height:40px;
            }
        </style>
    </head> 
    <body>  
        <%
            if (null == session.getAttribute("username")) {
                // User is not logged in.
        %>
        <jsp:forward page="login.jsp"></jsp:forward> 
        <%
            }
        %>    
        <div class="container h-100">
            <div class="mt-5 mb-3 clearfix">
                <h2 class="pull-left"  >Users List</h2>
                <div class="d-flex justify-content-center h-100">
                    <form class="form-inline" method="post" action="search.jsp" id="testform" >
                        <div class="searchbar">
                            <input class="search_input" type="text" name="id"  autocomplete="off" placeholder="Search...">
                            <a id="submitLink" href="#" class="search_icon"  >
                                <i class="fas fa-search" onclick="myFunction()" ></i></a> 
                        </div>
                    </form>
                </div>

                <a href="logout.jsp" class="btn btn-danger pull-left">Log out</a>
                <a style="margin-left: 10px;" href="adduserform.jsp" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Add New User</a>

            </div>
            <%
                List<User> list = UserDao.getAllRecords();
                request.setAttribute("list", list);
            %>  

            <table class="table table-bordered table-striped" >  
                <tr><th>Id</th><th>Name</th><th>Password</th><th>Email</th>  
                    <th>Sex</th><th>Country</th><th>Edit</th><th>Delete</th><th>Picture</th></tr>  
                        <c:forEach items="${list}" var="u">  
                    <tr><td>${u.getId()}</td>
                        <td>${u.getName()}</td>
                        <td>${u.getPassword()}</td>  
                        <td>${u.getEmail()}</td>
                        <td>${u.getSex()}</td>
                        <td>${u.getCountry()}</td>                         
                        <td><a href="editform.jsp?id=${u.getId()}">Edit</a></td>
                        <td><a href="deleteuser.jsp?id=${u.getId()}"  escapeXml="false" onclick="return permission(${u.getId()}, '${fn:replace(u.getName(), "'", "\\'")}');" >Delete</a></td>
                        <td><img id="myImg${u.getId()}" alt="${u.getName()}"class="myclass" onclick="return popup(${u.getId()}, '${u.getPicture()}')" src="http://localhost:8088/picture/${u.getPicture()}"/></td>
                    <div id="myModal" class="modal">

                        <!-- The Close Button -->
                        <span class="close">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img01">

                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                    </div>
                    </tr>
                </c:forEach>  


            </table>           
        </div>
        <script>// Get the modal

        </script>
    </body>  
</html>  