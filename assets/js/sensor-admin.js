// Track the last known state and times for each parking slot, including duration
let lastKnownStates = {
  slot1: { state: null, inTime: null, outTime: null, duration: null },
  slot2: { state: null, inTime: null, outTime: null, duration: null },
  slot3: { state: null, inTime: null, outTime: null, duration: null },
  slot4: { state: null, inTime: null, outTime: null, duration: null },
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
  let durationElement = document.getElementById(
    `duration${slotId.charAt(slotId.length - 1)}`
  );

  let currentDateTime = new Date();
  let currentDateTimeStr = currentDateTime.toLocaleString();

  let slotNumber = slotId.replace(/\D/g, ""); // Extract the numeric part from slotId

  // Check if the status actually changed
  if (status === 1 && lastKnownStates[slotId].state !== 1) {
    // Slot becomes available
    if (lastKnownStates[slotId].state === 0) {
      lastKnownStates[slotId].outTime = currentDateTimeStr; // Update out time
      outTimeElement.innerHTML = `OUT: ${lastKnownStates[slotId].outTime}`; // Display TIME OUT

      // Send AJAX request to update the log with time_out
      $.ajax({
        type: "POST",
        url: "assets/php/generate_logs.php", // Replace with actual backend PHP URL
        data: {
          slot_id: slotNumber, // Use the numeric part of slotId
          time_out: lastKnownStates[slotId].outTime,
        },
        success: function (response) {
          // Log success
        },
        error: function (error) {
          console.error(`Error updating log for ${parkingSlot}.`);
        },
      });
    }

    // Reset the duration when the slot becomes available
    lastKnownStates[slotId].duration = null; // Reset the duration
    durationElement.innerHTML = `Duration: N/A`; // Clear the displayed duration

    slotElement.classList.remove("bg-danger");
    slotElement.classList.add("bg-success");
    statusElement.innerHTML = `<strong>${parkingSlot} Available</strong>`;
    lastKnownStates[slotId].state = 1; // Update last known state
  } else if (status === 0 && lastKnownStates[slotId].state !== 0) {
    // Slot becomes occupied
    if (lastKnownStates[slotId].state === 1) {
      lastKnownStates[slotId].inTime = currentDateTimeStr; // Update in time
      inTimeElement.innerHTML = `IN: ${lastKnownStates[slotId].inTime}`; // Display TIME IN
      outTimeElement.innerHTML = null; // Clear out time

      // Send AJAX request to insert a new log with time_in
      $.ajax({
        type: "POST",
        url: "assets/php/generate_logs.php", // Replace with actual backend PHP URL
        data: {
          slot_id: slotNumber, // Use the numeric part of slotId
          time_in: lastKnownStates[slotId].inTime,
        },
        success: function (response) {
          // Log success
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

    // Start tracking parking duration
    updateParkingDuration(slotId, currentDateTime);
  }
}

// This function will handle duration updates when the slot is occupied
function updateParkingDuration(slotId, currentDateTime) {
  let inTimeElement = document.getElementById(`inTime${slotId.charAt(slotId.length - 1)}`);
  let outTimeElement = document.getElementById(`outTime${slotId.charAt(slotId.length - 1)}`);
  let durationElement = document.getElementById(`duration${slotId.charAt(slotId.length - 1)}`);

  // Update parking duration if slot is occupied
  if (lastKnownStates[slotId].state === 0 && lastKnownStates[slotId].inTime) {
    let inTime = new Date(lastKnownStates[slotId].inTime);
    let duration = currentDateTime - inTime; // Duration in milliseconds

    // Convert duration to days, hours, minutes, and seconds
    let days = Math.floor(duration / (1000 * 60 * 60 * 24)); // Days
    let hours = Math.floor((duration % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); // Hours
    let minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60)); // Minutes
    let seconds = Math.floor((duration % (1000 * 60)) / 1000); // Seconds

    // Display duration in real-time (including seconds)
    lastKnownStates[slotId].duration = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    durationElement.innerHTML = `Duration: ${lastKnownStates[slotId].duration}`;

    // Update every second as long as the slot is occupied
    setTimeout(function() {
      updateParkingDuration(slotId, new Date()); // Recursively update the duration
    }, 1000); // Update every second (1000 ms)
  }
}

function checkSensor() {
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
}
