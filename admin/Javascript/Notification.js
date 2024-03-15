window.onload = async function() {
    const getName = sessionStorage.getItem("name")
    console.log(getName)
    // fetch data
    await appointment("fillup",String(getName),"pending","")
    await appointment("proceed",String(getName),"accept","proceed")
    await appointment("proceed",String(getName),"reject","reject")
};

async function appointment(tableName,name,dataTable,type){

    try {
        const response = await fetch(mySecrets().api + "/show_appointment", {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'Authorization': mySecrets().secret
          },
          body: JSON.stringify({
            table: tableName,
            name: name
          })
      });

     
      const data = await response.json();
  
      renderTableData(data,dataTable,type);
   
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
    }
}

// Function to render data into the table
function renderTableData(data,tableName,type) {
    const tableBody = document.getElementById(tableName).querySelector('tbody');
    tableBody.innerHTML = ''
    if (tableName === "pending"){

        // Loop through the fetched data and populate the table
        data.forEach(appointment => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${appointment.uid}</td>
                <td>${appointment.name}</td>
                <td>${appointment.section}</td>
                <td>${appointment.department}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="acceptAppointment('${appointment.id}', '${appointment.uid}');">✔</button>
                    <button class="btn btn-danger btn-sm" onclick="rejectAppointment('${appointment.id}', '${appointment.uid}');">✘</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        return
    }

    console.log(data)
    // Loop through the fetched data and populate the table
    data.filter(data=>data.status === type).forEach(appointment => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${appointment.uid}</td>
            <td>${appointment.name}</td>
            <td>${appointment.section}</td>
            <td>${appointment.department}</td>
        `;
        tableBody.appendChild(row);
    });    

}

// update appointmen
async function update_appointment(status,id_value,uid_value){

    try {
        const response = await fetch(mySecrets().api + "/update_appointment", {
          method: 'PUT',
          headers: {
              'Content-Type': 'application/json',
              'Authorization': mySecrets().secret
          },
          body: JSON.stringify({
            status: status,
            id_value: id_value,
            uid_value: uid_value,
          })
      });

      if(response.ok){
        const data = await response.json();
        console.log(data)
        location.reload()
      }

   
    } catch (error) {
      console.error('There was a problem with the fetch operation:', error);
    }
}

// Function to handle accepting an appointment
async function acceptAppointment(id, uid) {
    update_appointment("proceed",id,uid);
}

// Function to handle rejecting an appointment
async function rejectAppointment(id, uid) {
    update_appointment("reject",id,uid);
}
