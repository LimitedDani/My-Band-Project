<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 12:02
 */
class user {
    static function login($email, $password, $mysqli) {
        if(!empty($email) && !empty($password)) {
            $hash = hash('sha256', $password);

            $sql="SELECT * FROM users WHERE email='$email' AND password='$hash'";
            $result = mysqli_query($mysqli, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($count > 0) {
                session_start();
                ob_start();
                $_SESSION['user'] = $row['ID'];
                $_SESSION['UUID'] = $row['UUID'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    static function getName($UUID, $mysqli) {
        $sql="SELECT name FROM users WHERE UUID='$UUID'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
}
class admin {
    static function getRoleID($uuid, $mysqli) {
        $sql="SELECT role FROM users WHERE UUID='$uuid'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['role'];
    }
    static function removeUser($uuid, $mysqli) {
        $sql = "DELETE FROM users WHERE UUID='$uuid'";
        $result = mysqli_query($mysqli, $sql);
    }
    static function getRole($role_id, $mysqli) {
        $sql="SELECT role_name FROM roles WHERE role_id='$role_id'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['role_name'];
    }
    static function addUser($name, $email, $password, $role, $mysqli) {
        $sql = "INSERT INTO users (UUID, name, email, password, role) VALUES (UUID(), '$name', '$email', '$password', '$role')";
        $result = mysqli_query($mysqli, $sql);
    }
    static function posts($mysqli) {
        $sql="SELECT ID,title,user,date FROM posts";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $content = '
        <table class="table">
          <thead class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Options</th>
            </tr>
          </thead>
          <tfoot class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Options</th>
            </tr>
          </tfoot>
          <tbody>';
        while($row = mysqli_fetch_assoc($result)) {
            $content .= '
                <tr class="animated fadeInUpBig">
                    <th >'.$row["ID"].'</th >
                    <td >'.$row["name"].'</td >
                    <td >'.$row["email"].'</td >
                    <td >********</td >
                    <td ><div class="block" >
                      <a class="button is-info" >Edit</a >
                      ';
            if(strcmp($_SESSION['UUID'], $row['UUID']) != 0) {
                $content .= '<a class="button is-danger" href="admin&p=users&removeuser=' . $row["UUID"] . '">Remove</a >';
            }
            $content .= '</div >
                    </td >
                </tr >';
        }
        $content .= '</tbody>
            </table>        <script src="js/modal.js"></script>
            ';
        return $content;
    }
    static function addPost($mysqli) {
        $content = '
        <script src="../libs/ckeditor/ckeditor.js"></script>
        <form>
            <textarea name="addpost" id="editor1" rows="10" cols="80">
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace("addpost");
            </script>
        </form>
        
        ';
        return $content;
    }
    static function users($mysqli) {
        $sql="SELECT ID,name,email,UUID,role FROM users";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $content = '
        <table class="table">
          <thead class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Role</th>
              <th>Options</th>
            </tr>
          </thead>
          <tfoot class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Role</th>
              <th>Options</th>
            </tr>
          </tfoot>
          <tbody>';
            while($row = mysqli_fetch_assoc($result)) {
                $content .= '
                <tr class="animated fadeInUpBig">
                    <th >'.$row["ID"].'</th >
                    <td >'.$row["name"].'</td >
                    <td >'.$row["email"].'</td >
                    <td >********</td >
                    <td>'.admin::getRole($row["role"], $mysqli).'</td>
                    <td ><div class="block" >
                      <a class="button is-info modal-button" data-target="#edituser'.$row["UUID"].'">Edit</a >
                      ';
                        if(strcmp($_SESSION['UUID'], $row['UUID']) != 0) {
                            $content .= '<a class="button is-danger" href="admin&p=users&removeuser=' . $row["UUID"] . '">Remove</a >';
                        }
                $content .='
                </td >
            </tr >';
                $content.= '
                    <div id="edituser'.$row["UUID"].'" class="modal">
                        <div class="modal-background">
                    
                        </div>
                        <div class="modal-content">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Edit user</p>
                            </header>
                            <form method="post" target="">
                                <div class="modal-card-body">
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Danique de Jong" value="'.$row["name"].'" id="name" name="name">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="email" placeholder="hello@" value="'.$row["email"].'" id="email" name="email">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Password</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="password" placeholder="********" value="" id="password" name="password">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Repeat Password</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="password" placeholder="********" value="" id="repeatpassword" name="repeatpassword">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Role</label>
                                        <p class="control">
                                            <span class="select">
                                                <select name="role" id="role">
                                                    <option value="5" '.(($row["role"] == 5) ? 'selected' : '').'>Super admin</option>
                                                    <option value="4" '.(($row["role"] == 4) ? 'selected' : '').'>Administrator</option>
                                                    <option value="3" '.(($row["role"] == 3) ? 'selected' : '').'>Editor</option>
                                                    <option value="2" '.(($row["role"] == 2) ? 'selected' : '').'>Author</option>
                                                    <option value="1" '.(($row["role"] == 1) ? 'selected' : '').'>Contributor</option>
                                                    <option value="0" '.(($row["role"] == 0) ? 'selected' : '').'>Subscriber</option>
                                                </select>
                                            </span>
                                        </p>
                                    </div>
                                    <input type="hidden" name="id" id="id" value="'.$row["ID"].'">
                                </div>
                                <footer class="modal-card-foot">
                                    <input type="submit" class="button is-success" value="Save" id="edituser" name="edituser">
                                </footer>
                            </form>
                        </div>
                                                <button class="modal-close"></button>

                    </div >';
            }
            $content .= '</tbody>
            </table>        <script src="js/modal.js"></script>
            ';
        return $content;
    }
    static function home($mysqli) {
        return 'nog niks';
    }
    static function getHeader($page)
    {
        switch ($page) {
            case 'users':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Users
                            </h1>
                            <div class="block">
                            <p>
                                <a class="button  modal-button" data-target="#adduser">Add user</a>
                            </p>
                        </div>
                    <div id="adduser" class="modal">
                        <div class="modal-background">
                    
                        </div>
                        <div class="modal-content">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Add user</p>
                            </header>
                            <form method="post" target="">
                                <div class="modal-card-body">
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Danique de Jong" value="" id="name" name="name">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="email" placeholder="hello@" value="" id="email" name="email">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Password</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="password" placeholder="********" value="" id="password" name="password">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Repeat Password</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="password" placeholder="********" value="" id="repeatpassword" name="repeatpassword">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Role</label>
                                        <p class="control">
                                            <span class="select">
                                                <select name="role" id="role">
                                                    <option value="5">Super admin</option>
                                                    <option value="4">Administrator</option>
                                                    <option value="3">Editor</option>
                                                    <option value="2">Author</option>
                                                    <option value="1">Contributor</option>
                                                    <option value="0">Subscriber</option>
                                                </select>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <footer class="modal-card-foot">
                                    <input type="submit" class="button is-success" value="Save" id="adduser" name="adduser">
                                </footer>
                            </form>
                        </div>
                        <button class="modal-close"></button>
                    </div>
                </div>
                <hr>';
                break;
            case 'home':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Dashboard
                            </h1>
                        </div>
                    </div>
                </div>
                <hr>';
                break;
            case 'roles':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Roles
                            </h1>
                        </div>
                    </div>
                </div>
                <hr>';
                break;
            case 'addpost':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Add page
                            </h1>
                        </div>
                    </div>
                </div>
                <hr>';
                break;
            default:
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Dashboard
                            </h1>
                        </div>
                    </div>
                </div>
                <hr>';
                break;
        }
    }
}
abstract class permissions {
    const ReachDashboard        = "reachDashboard";
    const ReachPosts            = "reachPosts";
    const ReachUsers            = "reachUsers";
    const AddUser               = "addUser";
    const EditUsers             = "editUsers";
    const RemoveUsers           = "removeUsers";
    const ManagePosts           = "managePosts";
    const AddPost               = "addPost";
    const ManageCategories      = "manageCategories";
    static function hasPermission($role_id, $permission, $mysqli) {
        $sql = "SELECT role_permissions FROM roles WHERE role_id='$role_id'";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        $permissions = $row['role_permissions'];
        if(strpos($permissions,  'all,') !== false) {
            return true;
        }
        if(empty($permissions)) {
            return false;
        }
        $exploded_permissions = explode(",", $permissions);
        for($i = 0; $i < count($exploded_permissions); $i++) {
            if(strcmp($exploded_permissions[i], $permission) == 0) {
                return true;
            }
            if(strcmp($exploded_permissions[i], 'all') == 0) {
                return true;
            }
        }
        return false;
    }
}