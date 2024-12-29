// Track the last known state and times for each parking slot
let lastKnownStates = {
  slot1: { state: null, inTime: null, outTime: null },
  slot2: { state: null, inTime: null, outTime: null },
  slot3: { state: null, inTime: null, outTime: null },
  slot4: { state: null, inTime: null, outTime: null },
};

function updateSlot(slotId, statusId, status, parkingSlot) {
  let slotElement = document.getElementById(slotId);
  let statusElement = document.getElementById(statusId);
  let inTimeElement = document.getElementById(
    `inTime${slotId.charAt(slotId.length - 1)}`
  );
  let outTimeElement = document.getElementById(
    `outTime${slotId.charAt(slotId.length - 1)}`
  );

  let currentDateTime = new Date().toLocaleString();

  let slotNumber = slotId.replace(/\D/g, ""); // Extract the numeric part from slotId

  if (status === 1) {
    // Slot is available
    if (lastKnownStates[slotId].state === 0) {
      lastKnownStates[slotId].outTime = currentDateTime; // Update out time
      outTimeElement.innerHTML = lastKnownStates[slotId].outTime; // Display TIME OUT

      // console.log(`${parkingSlot} Time: Out at ${lastKnownStates[slotId].outTime}`);

      // Send AJAX request to update the log with time_out
      $.ajax({
        type: "POST",
        url: "assets/php/generate_logs.php", // Replace with actual backend PHP URL
        data: {
          slot_id: slotNumber, // Use the numeric part of slotId
          time_out: lastKnownStates[slotId].outTime,
        },
        success: function (response) {
          // console.log(`Log updated for ${parkingSlot} with time_out.`);
        },
        error: function (error) {
          console.error(`Error updating log for ${parkingSlot}.`);
        },
      });
    }

    slotElement.classList.remove("bg-danger");
    slotElement.classList.add("bg-success");
    statusElement.innerHTML = `<strong>${parkingSlot} Available</strong>`;
    lastKnownStates[slotId].state = 1; // Update last known state
  } else {
    // Slot is occupied
    if (lastKnownStates[slotId].state === 1) {
      lastKnownStates[slotId].inTime = currentDateTime; // Update in time
      inTimeElement.innerHTML = lastKnownStates[slotId].inTime; // Display TIME IN
      outTimeElement.innerHTML = null; // Clear out time

      // console.log(`${parkingSlot} Time: In at ${lastKnownStates[slotId].inTime}`);

      // Send AJAX request to insert a new log with time_in
      $.ajax({
        type: "POST",
        url: "assets/php/generate_logs.php", // Replace with actual backend PHP URL
        data: {
          slot_id: slotNumber, // Use the numeric part of slotId
          time_in: lastKnownStates[slotId].inTime,
        },
        success: function (response) {
          // console.log(response);
        },
        error: function (error) {
          console.error(`Error inserting log for ${parkingSlot}.`);
        },
      });
    }

    slotElement.classList.remove("bg-success");
    slotElement.classList.add("bg-danger");
    statusElement.innerHTML = `<strong>${parkingSlot} Occupied</strong>`;
    lastKnownStates[slotId].state = 0; // Update last known state
  }
}

function updateImageAndLink(sensorStates) {
  // Determine the correct image filename based on sensor states
  let fileName = "";
  if (sensorStates.includes(1)) {
    let activeSensors = sensorStates
      .map((state, index) => (state === 1 ? index + 1 : null))
      .filter(Boolean);
    fileName = activeSensors.join("-");
  } else {
    fileName = "0"; // Default image if no sensors are active
  }

  // Update the href and src attributes
  const newPath = `assets/img/layout/${fileName}.png`;
  $("#layout-link").attr("href", newPath);
  $("#layout-image").attr("src", newPath);
}

function checkSensor() {
  const sensorUrls = [
    "http://10.0.0.1/d1",
    "http://10.0.0.1/d2",
    "http://10.0.0.1/d3",
    "http://10.0.0.1/d4",
  ];

  let sensorStates = Array(sensorUrls.length).fill(0); // Initialize sensor states to 0

  // Fetch sensor states
  let ajaxRequests = sensorUrls.map((url, index) => {
    return $.ajax({
      type: "GET",
      url: url,
      success: function (data) {
        // Assume sensorState is returned as 1 or 0
        sensorStates[index] = data.sensorState || 0;
      },
      error: function () {
        console.error(`Error fetching data for sensor ${index + 1}`);
      },
    });
  });

  // After all requests complete, update the image and link
  $.when(...ajaxRequests).done(() => {
    updateImageAndLink(sensorStates);
    $.ajax({
      type: "GET",
      url: "http://10.0.0.1/d1",
      success: function (data) {
        updateSlot("slot1", "status1", data.sensorState, "P1 - ");
      },
      error: function (data) {
        console.error("Error fetching data for slot 1");
      },
    });

    $.ajax({
      type: "GET",
      url: "http://10.0.0.1/d2",
      success: function (data) {
        updateSlot("slot2", "status2", data.sensorState, "P2 - ");
      },
      error: function (data) {
        console.error("Error fetching data for slot 2");
      },
    });

    $.ajax({
      type: "GET",
      url: "http://10.0.0.1/d3",
      success: function (data) {
        updateSlot("slot3", "status3", data.sensorState, "P3 - ");
      },
      error: function (data) {
        console.error("Error fetching data for slot 3");
      },
    });

    $.ajax({
      type: "GET",
      url: "http://10.0.0.1/d4",
      success: function (data) {
        updateSlot("slot4", "status4", data.sensorState, "P4 - ");
      },
      error: function (data) {
        console.error("Error fetching data for slot 4");
      },
    });
  });
}
