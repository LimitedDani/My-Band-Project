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

            $sql="SELECT * FROM ".$GLOBALS['table_prefix']."users WHERE email='$email' AND password='$hash'";
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
        $sql="SELECT name FROM ".$GLOBALS['table_prefix']."users WHERE UUID='$UUID'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
    static function getRoleID($uuid, $mysqli) {
        $sql="SELECT role FROM ".$GLOBALS['table_prefix']."users WHERE UUID='$uuid'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['role'];
    }
    static function getAll($mysqli) {
        $sql="SELECT ID,name,email,UUID,role FROM ".$GLOBALS['table_prefix']."users";
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
    static function removeUser($uuid, $mysqli) {
        $sql = "DELETE FROM ".$GLOBALS['table_prefix']."users WHERE UUID='$uuid'";
        $result = mysqli_query($mysqli, $sql);
    }
    static function addUser($name, $email, $password, $role, $mysqli) {
        $sql = "INSERT INTO ".$GLOBALS['table_prefix']."users (UUID, name, email, password, role) VALUES (UUID(), '$name', '$email', '$password', '$role')";
        $result = mysqli_query($mysqli, $sql);
    }
}
class admin {
    static function addEvent($title, $description, $start_date, $start_time, $end_date, $end_time, $mysqli) {
        $sql = "INSERT INTO ".$GLOBALS['table_prefix']."agenda (title, description, start_d, start_t, end_d, end_t, author) VALUES ('$title', '$description', '$start_date', '$start_time', '$end_date', '$end_time', '".$_SESSION['UUID']."')";
        $result = mysqli_query($mysqli, $sql);
        return mysqli_error($mysqli);
    }
    static function getRole($role_id, $mysqli) {
        $sql="SELECT role_name FROM ".$GLOBALS['table_prefix']."roles WHERE role_id='$role_id'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['role_name'];
    }
    static function getPosts($mysqli) {
        $sql="SELECT ID,title,user,date FROM ".$GLOBALS['table_prefix']."posts";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $content = '
        <table class="table">
          <thead class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <td>Title</td>
              <td>Author</td>
              <td>Placed</td>
              <td>Options</td>
            </tr>
          </thead>
          <tfoot class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <td>Title</td>
              <td>Author</td>
              <td>Placed</td>
              <td>Options</td>
            </tr>
          </tfoot>
          <tbody>';
        while($row = mysqli_fetch_assoc($result)) {
            $content .= '
                <tr class="animated fadeInUpBig">
                    <th >'.$row["ID"].'</th >
                    <td >'.$row["title"].'</td >
                    <td >'.user::getName($row["user"], $mysqli).'</td >
                    <td >'.$row["date"].'</td >
                    <td ><div class="block" >
                      <a class="button is-info" >Edit</a >
                      ';
            if(strcmp($_SESSION['UUID'], $row['UUID']) != 0) {
                $content .= '<a class="button is-danger" href="admin&p=manageposts&removepost=' . $row["ID"] . '">Remove</a >';
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
                            <form method="post" target="">
                                            <div class="field">
                                        <label class="label">Title</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Title" value="" id="title" name="title">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Post</label>
             <p class="control has-icons-left has-icons-right">
            <textarea name="text" id="text" rows="10" cols="80">
            </textarea>
                                        </p>
                                    </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace("text");
            </script>
            <input type="submit" class="button is-success" value="Post" id="addpost" name="addpost">
        </form>
        
        ';
        return $content;
    }
    static function home($mysqli) {
        return 'nog niks';
    }
    static function removePost($id, $mysqli) {
        $sql = "DELETE FROM ".$GLOBALS['table_prefix']."posts WHERE ID='$id'";
        $result = mysqli_query($mysqli, $sql);
    }
    static function removeEvent($id, $mysqli) {
        $sql = "DELETE FROM ".$GLOBALS['table_prefix']."agenda WHERE ID='$id'";
        $result = mysqli_query($mysqli, $sql);
    }
    static function getHeader($page)
    {
        switch ($page) {
            case 'agenda':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Agenda
                            </h1>
                            <div class="block">
                            <p>
                                <a class="button  modal-button" data-target="#addevent">Add event</a>
                            </p>
                        </div>
                    <div id="addevent" class="modal">
                        <div class="modal-background">
                    
                        </div>
                        <div class="modal-content">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Add event</p>
                            </header>
                            <form method="post" target="">
                                <div class="modal-card-body">
                                    <div class="field">
                                        <label class="label">Title</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Title" value="" id="title" name="title">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Description</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Description" value="" id="description" name="description">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Start</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="date" placeholder="01-01-2000" value="" id="start-date" name="start-date">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </p>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="time" placeholder="12:00" value="" id="start-time" name="start-time">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">End</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="date" placeholder="01-01-2000" value="" id="end-date" name="end-date">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </p>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="time" placeholder="12:00" value="" id="end-time" name="end-time">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <footer class="modal-card-foot">
                                    <input type="submit" class="button is-success" value="Add" id="addevent" name="addevent">
                                </footer>
                            </form>
                        </div>
                        <button class="modal-close"></button>
                    </div>
                </div>
                <hr>';
                break;
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
            case 'addpost':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Add Post
                            </h1>
                        </div>
                    </div>
                </div>
                <hr>';
                break;
            case 'manageposts':
                return '
                <div class="hero">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Manage Posts
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
    static function getCalender($mysqli) {
        $sql="SELECT * FROM ".$GLOBALS['table_prefix']."agenda";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $content = '
        <table class="table">
          <thead class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Start</th>
              <th>End</th>
              <th>Options</th>
            </tr>
          </thead>
          <tfoot class="animated fadeInUpBig">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Start</th>
              <th>End</th>
              <th>Options</th>
            </tr>
          </tfoot>
          <tbody>';
        while($row = mysqli_fetch_assoc($result)) {
            $content .= '
                <tr class="animated fadeInUpBig">
                    <th >'.$row["ID"].'</th >
                    <td >'.$row["title"].'</td >
                    <td >'.$row["start_d"].' om '.$row["start_t"].'</td >
                    <td >'.$row["end_d"].' om '.$row["end_t"].'</td >
                    <td ><div class="block" >
                      <a class="button is-info modal-button" data-target="#editevent'.$row["ID"].'">Edit</a >
                      ';
            if(strcmp($_SESSION['UUID'], $row['UUID']) != 0) {
                $content .= '<a class="button is-danger" href="admin&p=agenda&removeevent=' . $row["ID"] . '">Remove</a >';
            }
            $content .='
                </td >
            </tr >';
            $content.= '
                    <div id="editevent'.$row["ID"].'" class="modal">
                        <div class="modal-background">
                    
                        </div>
                        <div class="modal-content">
                            <header class="modal-card-head">
                                <p class="modal-card-title">Edit event</p>
                            </header>
                            <form method="post" target="">
                                <div class="modal-card-body">
                                    <div class="field">
                                        <label class="label">Title</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Title" value="'.$row["title"].'" id="title" name="title">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Description</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Description" value="'.$row["description"].'" id="description" name="description">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">Start</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="date" placeholder="01-01-2000" value="'.$row["start_d"].'" id="start-date" name="start-date">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </p>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="time" placeholder="12:00" value="'.$row["start_t"].'" id="start-time" name="start-time">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <label class="label">End</label>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="date" placeholder="01-01-2000" value="'.$row["end_d"].'" id="end-date" name="end-date">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </p>
                                        <p class="control has-icons-left has-icons-right">
                                            <input class="input" type="time" placeholder="12:00" value="'.$row["end_t"].'" id="end-time" name="end-time">
                                            <span class="icon is-small is-left">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <input type="hidden" name="id" id="id" value="'.$row["ID"].'">
                                </div>
                                <footer class="modal-card-foot">
                                    <input type="submit" class="button is-success" value="Save" id="editevent" name="editevent">
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
        if(strcmp($role_id, '5') == 0) {
            return true;
        }
    }
}
class common {
    function truncate_html($html, $length = 100, $ending = '...')
    {
        if (!is_string($html)) {
            trigger_error('Function \'truncate_html\' expects argument 1 to be an string', E_USER_ERROR);
            return false;
        }

        if (mb_strlen(strip_tags($html)) <= $length) {
            return $html;
        }
        $total = mb_strlen($ending);
        $open_tags = array();
        $return = '';
        $finished = false;
        $final_segment = '';
        $self_closing_elements = array(
            'area',
            'base',
            'br',
            'col',
            'frame',
            'hr',
            'img',
            'input',
            'link',
            'meta',
            'param'
        );
        $inline_containers = array(
            'a',
            'b',
            'abbr',
            'cite',
            'em',
            'i',
            'kbd',
            'span',
            'strong',
            'sub',
            'sup'
        );
        while (!$finished) {
            if (preg_match('/^<(\w+)[^>]*>/', $html, $matches)) { // Does the remaining string start in an opening tag?
                // If not self-closing, place tag in $open_tags array:
                if (!in_array($matches[1], $self_closing_elements)) {
                    $open_tags[] = $matches[1];
                }
                // Remove tag from $html:
                $html = substr_replace($html, '', 0, strlen($matches[0]));
                // Add tag to $return:
                $return .= $matches[0];
            } elseif (preg_match('/^<\/(\w+)>/', $html, $matches)) { // Does the remaining string start in an end tag?
                // Remove matching opening tag from $open_tags array:
                $key = array_search($matches[1], $open_tags);
                if ($key !== false) {
                    unset($open_tags[$key]);
                }
                // Remove tag from $html:
                $html = substr_replace($html, '', 0, strlen($matches[0]));
                // Add tag to $return:
                $return .= $matches[0];
            } else {
                // Extract text up to next tag as $segment:
                if (preg_match('/^([^<]+)(<\/?(\w+)[^>]*>)?/', $html, $matches)) {
                    $segment = $matches[1];
                    // Following code taken from https://trac.cakephp.org/browser/tags/1.2.1.8004/cake/libs/view/helpers/text.php?rev=8005.
                    // Not 100% sure about it, but assume it deals with utf and html entities/multi-byte characters to get accureate string length.
                    $segment_length = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $segment));
                    // Compare $segment_length + $total to $length:
                    if ($segment_length + $total > $length) { // Truncate $segment and set as $final_segment:
                        $remainder = $length - $total;
                        $entities_length = 0;
                        if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $segment, $entities, PREG_OFFSET_CAPTURE)) {
                            foreach($entities[0] as $entity) {
                                if ($entity[1] + 1 - $entities_length <= $remainder) {
                                    $remainder--;
                                    $entities_length += mb_strlen($entity[0]);
                                } else {
                                    break;
                                }
                            }
                        }
                        // Otherwise truncate $segment and set as $final_segment:
                        $finished = true;
                        $final_segment = mb_substr($segment, 0, $remainder + $entities_length);
                    } else {
                        // Add $segment to $return and increase $total:
                        $return .= $segment;
                        $total += $segment_length;
                        // Remove $segment from $html:
                        $html = substr_replace($html, '', 0, strlen($segment));
                    }
                } else {
                    $finshed = true;
                }
            }
        }
        // Check for spaces in $final_segment:
        if (strpos($final_segment, ' ') === false && preg_match('/<(\w+)[^>]*>$/', $return)) { // If none and $return ends in an opening tag: (we ignore $final_segment)
            // Remove opening tag from end of $return:
            $return = preg_replace('/<(\w+)[^>]*>$/', '', $return);
            // Remove opening tag from $open_tags:
            $key = array_search($matches[3], $open_tags);
            if ($key !== false) {
                unset($open_tags[$key]);
            }
        } else { // Otherwise, truncate $final_segment to last space and add to $return:
            // $spacepos = strrpos($final_segment, ' ');
            $return .= mb_substr($final_segment, 0, mb_strrpos($final_segment, ' '));
        }
        $return = trim($return);
        $len = strlen($return);
        $last_char = substr($return, $len - 1, 1);
        if (!preg_match('/[a-zA-Z0-9]/', $last_char)) {
            $return = substr_replace($return, '', $len - 1, 1);
        }
        // Add closing tags:
        $closing_tags = array_reverse($open_tags);
        $ending_added = false;
        foreach($closing_tags as $tag) {
            if (!in_array($tag, $inline_containers) && !$ending_added) {
                $return .= $ending;
                $ending_added = true;
            }
            $return .= '</' . $tag . '>';
        }
        return $return;
    }
}