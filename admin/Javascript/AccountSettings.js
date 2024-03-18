async function update_password(){
        var uid = sessionStorage.getItem("userID");
        var old_password = document.getElementById("cpassword").value;
        var new_password = document.getElementById("npassword").value;
        console.log(old_password)
        console.log(new_password)
  
          try {
            const response = await fetch(mySecrets().api + "/change_password", {
              method: 'PUT',
              headers: {
                  'Content-Type': 'application/json',
                  'Authorization': mySecrets().secret
              },
              body: JSON.stringify({
                uid: uid,
                old_password: old_password,
                new_password: new_password
              })
          });
  
         
          const data = await response.json();
          alert(data)
          location.reload()
       
      } catch (error) {
          console.error('There was a problem with the fetch operation:', error);
      }
}


window.onload = function () {
    // document.getElementById("name").value = sessionStorage.getItem("name");
    // document.getElementById("username").value = sessionStorage.getItem("username");
    // document.getElementById("rfid").value = sessionStorage.getItem("cardUID");

    document.getElementById("name").value = sessionStorage.getItem("name");
    document.getElementById("username").value = sessionStorage.getItem("username");
    document.getElementById("rfid").value = sessionStorage.getItem("cardUID");

}