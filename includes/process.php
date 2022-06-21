<?php 
require('connection.php');


// admin authentiatcation 


if(isset($_POST['actionString']) && $_POST['actionString']=='loginAdmin')
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="select * from users where (username='$username' or email='$username') and password='$password' and privilage='admin' and status='enable' ";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result)==1)
    {
            $row=mysqli_fetch_assoc($result);
            $_SESSION['name']=$row['name'];
            $_SESSION['surname']=$row['surname'];
            $_SESSION['username']=$row['username'];
            $_SESSION['password']=$row['password'];
            $_SESSION['userid']=$row['userid'];
            $_SESSION['email']=$row['email'];
            $_SESSION['address']=$row['address'];
            $_SESSION['dob']=$row['dob'];
            $_SESSION['privilage']=$row['privilage'];
            $_SESSION['status']=$row['status'];
        echo "true";
    }        
    else 
    echo "false";
}




// customer authentiatcation 


if(isset($_POST['actionString']) && $_POST['actionString']=='loginCustomer')
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="select * from users inner join customer on customer.userid=users.userid where (username='$username' or email='$username') and password='$password' and privilage='customer' and status='enable' ";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result)==1)
    {
            $row=mysqli_fetch_assoc($result);
            $_SESSION['name']=$row['name'];
            $_SESSION['surname']=$row['surname'];
            $_SESSION['username']=$row['username'];
            $_SESSION['password']=$row['password'];
            $_SESSION['customerid']=$row['customerid'];
            $_SESSION['userid']=$row['userid'];
            $_SESSION['email']=$row['email'];
            $_SESSION['address']=$row['address'];
            $_SESSION['dob']=$row['dob'];
            $_SESSION['privilage']=$row['privilage'];
            $_SESSION['status']=$row['status'];
        echo "true";
    }        
    else 
    echo "false";
}


// insertion of mobile record
if(isset($_POST['actionString']) && $_POST['actionString']=='insertionMobile')
{
    $model = $_POST['model'];
    $color = $_POST['color'];
    $series = $_POST['series'];
    $brand = $_POST['brand'];
    $realMobileImageName=$_FILES['mobileImage']['name'];
    $tempname=$_FILES['mobileImage']['tmp_name'];
    $finalName=time().".jpg";
    $destination="../mobileImages/".$finalName;
    move_uploaded_file($tempname,$destination);
    $query="insert into tblmobile (mobilebrand,mobileseries,mobilemodel,mobilecolor,mobileimage) values ('$brand','$series','$model','$color','$finalName');";
    if(mysqli_query($connection,$query))
        echo "true";
        else 
        echo "false";
}

// loading of mobile data
if(isset($_POST['actionString']) && $_POST['actionString']=='loadMobile')
{
  
    $query="select * from tblmobile";
 $result=mysqli_query($connection,$query);
 $html=array();
 while($row=mysqli_fetch_assoc($result))
 {
     $rows=array();
     $rows[]=$row['mobileid'];
     $rows[]=$row['mobilebrand'];
     $rows[]=$row['mobileseries'];
     $rows[]=$row['mobilemodel'];
     $rows[]=$row['mobilecolor'];
     $rows[]="<img src='mobileImages/".$row['mobileimage']."' width='100px' height='100px'>";
     $rows[]="<button class='btn btn-warning editButton mr-1' value='".$row['mobileid']."'>Edit</button><button class='btn btn-danger deleteButton' value='".$row['mobileid']."'>Delete</button>";
      $html[]=$rows;
 }
echo json_encode($html);
}
// retrieveing a  mobile record
if(isset($_POST['actionString']) && $_POST['actionString']=='getMobile')
{
$value=$_POST['value'];
$query="select * from tblmobile where mobileid=".$value;
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_assoc($result);
echo json_encode($row);
}


// updating mobile record

// insertion of mobile record
if(isset($_POST['actionString']) && $_POST['actionString']=='updateMobile')
{
    $id=$_POST['mobileid'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $series = $_POST['series'];
    $brand = $_POST['brand'];
    if(isset($_FILES['mobileImage']) && $_FILES['mobileImage']['error']==UPLOAD_ERR_OK)
    {
        // retrieving older company logo name to delete it from folder in case of image update
        $q="select * from tblmobile where mobileid=".$id;
        $result=mysqli_query($connection,$q);
        $row=mysqli_fetch_assoc($result);
        
        // updating the image
        $realImageName = $_FILES['mobileImage']['name'];
        $tempName = $_FILES['mobileImage']['tmp_name'];
        $finalDatabaseName = time().".jpg";
        $destination = "../mobileImages/".$finalDatabaseName;
        move_uploaded_file($tempName,$destination);
        $query="update tblmobile set mobileimage='$finalDatabaseName' where mobileid=$id";    
        if(mysqli_query($connection,$query))
        {
            if(!empty($row['mobileimage']) && file_exists('../mobileImages/'.$row['mobileimage']))
                    unlink('../mobileImages/'.$row['mobileimage']);
        }
    }
    $query="update  tblmobile set mobilebrand='$brand',mobileseries='$series',mobilemodel='$model',mobilecolor='$color' where mobileid='$id'";
    if(mysqli_query($connection,$query))
        echo "true";
        else 
        echo "false";
}
// deletion of mobile record
if(isset($_POST['actionString']) && $_POST['actionString']=='deleteMobile')
{
    $id=$_POST['value'];
    $query="delete from tblmobile where mobileid='$id'";
    if(mysqli_query($connection,$query))
        echo "true";
        else 
        echo "false";
}




// user registration 
if(isset($_POST['actionString']) && $_POST['actionString']=="UserRegistration")
{
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $address=$_POST['address'];
    $dob=$_POST['dob'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $query="insert into users (username,password,name,surname,email,address,dob) values('$username','$password','$name','$lastname','$email','$address','$dob')";
 //  echo $query;
    if(mysqli_query($connection,$query))
    echo "true";
    else 
    echo "false";

}

// customer page

if(isset($_POST['actionString']) && $_POST['actionString']=="loadUsers")
{
    $query="select * from users where privilage!='admin'";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['userid'];
        $rows[]=$row['username'];
        $rows[]=$row['password'];
        $rows[]=$row['name'];
        $rows[]=$row['surname'];
        $rows[]=$row['address'];
        $rows[]=$row['dob'];
        $rows[]=$row['email'];
        if($row['status']=="pending")
        $rows[]="<button class='btn btn-success btn-sm approveButton' value='".$row['userid']."'>Approve</button>";
        else
        $rows[]=$row['status'];
        if($row['status']=='enable')
        $rows[]="<button class='btn btn-danger btn-sm deleteButton' value='".$row['userid']."'>Delete</button>";
        else 
        $rows[]="<button class='btn btn-danger btn-sm deleteButton 'disabled value='".$row['userid']."'>Delete</button>";
        
         $html[]=$rows;
    }
   echo json_encode($html);
}

//approve user
if(isset($_POST['actionString']) && $_POST['actionString']=="approveUser")
{
    $userid=$_POST['userid'];
    $query="update users set status='enable' where userid=".$userid.";";
    $query.="insert into customer (userid) values('$userid');";
    if(mysqli_multi_query($connection,$query))
    echo "true";
    else 
    echo "false";
}
//action user
 if(isset($_POST['actionString']) && $_POST['actionString']=="actionUser")
{
    $userid=$_POST['userid'];
    $query="update users set status='disable' where userid=".$userid.";";
    if(mysqli_query($connection,$query))
    echo "true";
    else 
    echo "false";
}

// purchase code

// searchMobile
if(isset($_POST['actionString']) && $_POST['actionString']=="searchMobile")
{
    $key=$_POST['key'];
    $query="select * from tblmobile where mobileid like '%$key%' or mobilebrand like '%$key%' or mobilecolor like '%$key%' or mobilemodel like '%$key%' or mobileseries like '%$key%' ";
    $html=array();
    $result=mysqli_query($connection,$query);
    
            while($row=mysqli_fetch_assoc($result)){
                        array_push($html,$row);
            }
            echo json_encode($html);
}

// purchase insertion 
if(isset($_POST['actionString']) && $_POST['actionString']=="insertionPurchase")
{
    $mobile=$_POST['mobile'];
    $date=$_POST['date'];
    $amount=$_POST['amount'];
    $price=$_POST['price'];
    $mobile=explode(" ",$mobile);
    $query="insert into purchase (purchasedate,purchaseamount,purchaseprice,mobileid) values('$date','$amount','$price','$mobile[0]');";
    $q1="select * from stock where mobileid='$mobile[0]'";
    $result=mysqli_query($connection,$q1);
    if(mysqli_num_rows($result)==1)
        {
            $q1="update stock set amount=amount+$amount where mobileid=$mobile[0];";
        } else{
            $q1="insert into stock (mobileid,amount) values($mobile[0],$amount);";
        }
        
        $query=$query.$q1;
   //   echo $query;
    if(mysqli_multi_query($connection,$query))
    echo "true";
    else 
    echo "false";

}

// loding purchase

if(isset($_POST['actionString']) && $_POST['actionString']=="loadPurchase")
{
    $query="select * from purchase inner join tblmobile on tblmobile.mobileid=purchase.mobileid";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['purchaseid'];
        $rows[]=$row['purchasedate'];
        $rows[]=$row['purchaseamount'];
        $rows[]=$row['purchaseprice'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['mobileseries'];
        $rows[]="<button class='btn btn-danger btn-sm deleteButton' value='".$row['purchaseid']."'>Delete</button>";
         $html[]=$rows;
    }
   echo json_encode($html);
}


// purchase insertion 
if(isset($_POST['actionString']) && $_POST['actionString']=="deletePurchase")
{
    $purchaseid=$_POST['purchaseid'];
    
    
    $q1="select * from purchase where purchaseid='$purchaseid'";
    $result=mysqli_query($connection,$q1);
            $row=mysqli_fetch_assoc($result);
            $q1="update stock set amount=if(amount>=".$row['purchaseamount'].",amount-".$row['purchaseamount'].",0) where mobileid=".$row['mobileid'].";";
        $query="delete from purchase where purchaseid=$purchaseid;";
        $query=$query.$q1;
   //   echo $query;
    if(mysqli_multi_query($connection,$query))
    echo "true";
    else 
    echo "false";

}


// loading Stock

if(isset($_POST['actionString']) && $_POST['actionString']=="loadStock")
{
    $query="select * from stock inner join tblmobile on tblmobile.mobileid=stock.mobileid";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['stockid'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['mobileseries'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['amount'];
         $html[]=$rows;
    }
   echo json_encode($html);
}

//client server codes
// load client items

if(isset($_POST['actionString']) && $_POST['actionString']=="loadClientItems")
{
    $query="select *from tblmobile inner join stock on tblmobile.mobileid=stock.mobileid";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        if($row['amount']!=0)
        {
        $rows=array();
        $rows[]=$row['stockid'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobileseries'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['amount'];
                $q1="select (max(purchase.purchaseprice)+10) as price from purchase where purchase.mobileid=".$row['mobileid'];
                $r1=mysqli_query($connection,$q1);
                $row1=mysqli_fetch_assoc($r1);
        $rows[]=$row1['price'];
        $rows[]="<img src='mobileImages/".$row['mobileimage']."' height=100px width=100px>";
        if($row['amount']==0)
        $rows[]="<button class='btn btn-danger btn-sm orderButton disabled' value='".$row['stockid']."'>Order</button>";
        else
        $rows[]="<button class='btn btn-danger btn-sm orderButton' value='".$row['stockid']."'>Order</button>";
        
        $html[]=$rows;
         }
     }
   echo json_encode($html);
}

// getorder
// retrieveing a  mobile record
if(isset($_POST['actionString']) && $_POST['actionString']=='getOrder')
{
$value=$_POST['value'];
$query="select *,(max(purchase.purchaseprice)+10) as price from tblmobile inner join stock on stock.mobileid=tblmobile.mobileid inner join purchase on tblmobile.mobileid=purchase.mobileid where stockid=".$value;
$result=mysqli_query($connection,$query);
$row=mysqli_fetch_assoc($result);
echo json_encode($row);
}

// process order
// process the order
if(isset($_POST['actionString']) && $_POST['actionString']=='processOrder')
{
$stockid=$_POST['stockid'];
$mobileid=$_POST['mobileid'];
$amount=$_POST['orderAmount'];
$price=$_POST['price'];
$customerid=$_SESSION['customerid'];
$date=date('yy-m-d');
$query="insert into tblorder (mobileid,orderamount,orderprice,orderdate,customerid) values('$mobileid','$amount','$price','$date','$customerid')";
//echo $query;
if(mysqli_query($connection,$query))
echo "true";
else
echo"false";

}

// load ordered items

if(isset($_POST['actionString']) && $_POST['actionString']=="loadOrderItems")
{
    $query="select *from tblmobile inner join tblorder on tblmobile.mobileid=tblorder.mobileid where customerid=".$_SESSION['customerid'];
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['orderid'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobileseries'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['orderamount'];
        $rows[]=$row['orderprice'];
        $rows[]="<img src='mobileImages/".$row['mobileimage']."' height=100px width=100px>";
        $rows[]=$row['status'];
        if($row['status']=='approved' || $row['status']=='cancelled')
        $rows[]="<button type='button' class='btn btn-warning btn-sm actionButton' disabled value='".$row['orderid']."'>Cancel</button>";
        else
        $rows[]="<button type='button' class='btn btn-warning btn-sm actionButton' value='".$row['orderid']."'>Cancel</button>";
        
        $html[]=$rows;
         
     }
   echo json_encode($html);
}

// cancelOrder 

if(isset($_POST['actionString']) && $_POST['actionString']=='cancelOrder')
{
$orderid=$_POST['orderid'];
$query="update tblorder set status='cancelled' where orderid='$orderid'";
//echo $query;
if(mysqli_query($connection,$query))
echo "true";
else
echo"false";

}

//  load orders into the admin  

if(isset($_POST['actionString']) && $_POST['actionString']=="loadOrders")
{
    $query="select tblmobile.*,users.*,tblorder.orderid,tblorder.orderamount,tblorder.orderprice,tblorder.orderdate,tblorder.status as orderstatus from tblmobile inner join tblorder on tblmobile.mobileid=tblorder.mobileid
    inner join customer on customer.customerid=tblorder.customerid
    inner join users on users.userid=customer.userid";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['orderid'];
        $rows[]=$row['name']." ".$row['surname'];
        $rows[]=$row['email'];
        $rows[]=$row['address'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobileseries'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['orderamount'];
        $rows[]=$row['orderprice'];
        $rows[]=$row['orderdate'];
        $rows[]=$row['orderstatus'];
      if($row['orderstatus']=='pending')
        $rows[]="<button type='button' class='btn btn-warning btn-sm cancelButton mr-1'  value='".$row['orderid']."'>Cancel</button><button type='button' class='btn btn-success btn-sm approveButton'  value='".$row['orderid']." ".$row['orderamount']." ".$row['mobileid']."'>Approve</button>";
       else 
       $rows[]="";
        $html[]=$rows;
         
     }
   echo json_encode($html);
}

// cancel order from admin side

if(isset($_POST['actionString']) && $_POST['actionString']=="cancelAdminOrder")
{
    $orderid=$_POST['orderid'];
    $query="update tblorder set status='cancelled' where orderid=$orderid";
    if(mysqli_query($connection,$query))
    echo "true";
    else 
    echo "false";
    
}


// cancel order from admin side

if(isset($_POST['actionString']) && $_POST['actionString']=="approveAdminOrder")
{
    $values=$_POST['value'];
    $values=explode(" ",$values);
    $q1="update tblorder set status='approved' where orderid=".$values[0].";";
    $q2="insert into sale (saledate,saleamount,saleprice,mobileid,customerid) select orderdate,orderamount,orderprice,mobileid,customerid from tblorder where tblorder.orderid=".$values[0].";";
    $q3="update stock set amount=amount-".$values[1]." where mobileid=".$values[2].";";
    $query=$q1.$q2.$q3;
    //echo $query;
        if(mysqli_multi_query($connection,$query))
    echo "true";
    else 
    echo "false";
    
}


//  load orders into the admin  

if(isset($_POST['actionString']) && $_POST['actionString']=="loadSalesAdmin")
{
    $query="select * from tblmobile inner join sale on tblmobile.mobileid=sale.mobileid
    inner join customer on customer.customerid=sale.customerid
    inner join users on users.userid=customer.userid";
    $result=mysqli_query($connection,$query);
    $html=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $rows=array();
        $rows[]=$row['saleid'];
        $rows[]=$row['name']." ".$row['surname'];
        $rows[]=$row['email'];
        $rows[]=$row['address'];
        $rows[]=$row['mobilebrand'];
        $rows[]=$row['mobileseries'];
        $rows[]=$row['mobilemodel'];
        $rows[]=$row['mobilecolor'];
        $rows[]=$row['saledate'];
        $rows[]=$row['saleamount'];
        $rows[]=$row['saleprice'];
        $rows[]="<img src='mobileImages/".$row['mobileimage']."' height=100px width=100px>";
     
        $html[]=$rows;
         
     }
   echo json_encode($html);
}


// admin profile update

// user registration 
if(isset($_POST['actionString']) && $_POST['actionString']=="adminUpdateProfile")
{
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $address=$_POST['address'];
    $dob=$_POST['dob'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $userid=$_POST['userid'];
    $query=" update users set username='$username', password='$password', name='$name',surname='$lastname',email='$email', address='$address',dob='$dob' where userid='$userid'";
 //  echo $query;
 $_SESSION['name']=$_POST['name'];
 $_SESSION['surname']=$_POST['lastname'];
 $_SESSION['username']=$_POST['username'];
 $_SESSION['password']=$_POST['password'];
 $_SESSION['email']=$_POST['email'];
 $_SESSION['address']=$_POST['address'];
 $_SESSION['dob']=$_POST['dob'];
    if(mysqli_query($connection,$query))
    echo "true";
    else 
    echo "false";

}

//customerUpdateProfile

if(isset($_POST['actionString']) && $_POST['actionString']=="customerUpdateProfile")
{
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $address=$_POST['address'];
    $dob=$_POST['dob'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $userid=$_POST['userid'];
    $query=" update users set username='$username', password='$password', name='$name',surname='$lastname',email='$email', address='$address',dob='$dob' where userid='$userid'";
 //  echo $query;
 $_SESSION['name']=$_POST['name'];
 $_SESSION['surname']=$_POST['lastname'];
 $_SESSION['username']=$_POST['username'];
 $_SESSION['password']=$_POST['password'];
 $_SESSION['email']=$_POST['email'];
 $_SESSION['address']=$_POST['address'];
 $_SESSION['dob']=$_POST['dob'];
    if(mysqli_query($connection,$query))
    echo "true";
    else 
    echo "false";

}