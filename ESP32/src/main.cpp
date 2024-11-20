    #include <ESP8266WiFi.h>
    #include <DNSServer.h>
    #include <ESP8266WebServer.h>
    #include <Servo.h>
    #include <ArduinoJson.h>  // Include ArduinoJson library

    // WiFi credentials
    const char *ssid = "Project";
    const char *password = "12345679";

    // DNS and Web Server setup
    DNSServer dnsServer;
    IPAddress apIP(10, 0, 0, 1);
    ESP8266WebServer webServer(80);

    // Hardware definitions
    Servo servoEntrance;
    Servo servoExit;

    // Sensor pins
    const int slotSensors[] = {D1, D2, D3, D4}; // Parking slots IR sensors
    const int entranceSensor = D5;              // Entrance IR sensor
    const int exitSensor = D6;                  // Exit IR sensor

    // Servo motor pins
    const int servoEntrancePin = D7;
    const int servoExitPin = D8;

    // Variables
    unsigned long entranceOpenTime = 0;
    unsigned long exitOpenTime = 0;
    bool entranceGateOpen = false;
    bool exitGateOpen = false;

    // Function to open entrance gate
    void openEntranceGate() {
        servoEntrance.write(150);              // Open entrance gate
        entranceOpenTime = millis();          // Record entrance gate open time
        entranceGateOpen = true;  
    }

    // Function to open exit gate
    void openExitGate() {
        servoExit.write(150);                  // Open exit gate
        exitOpenTime = millis();              // Record exit gate open time
        exitGateOpen = true;   
    }

    // Function to handle the entrance gate operation
    void handleEntranceGate() {
        int entranceState = digitalRead(entranceSensor);
        
        // Check entrance sensor
        if (entranceState == LOW && !entranceGateOpen) {
            openEntranceGate();  // Open entrance gate if triggered and not already open
        }

        // Close entrance gate after 3 seconds
        if (entranceGateOpen && millis() - entranceOpenTime > 3000) {
            servoEntrance.write(0);               // Close entrance gate
            entranceGateOpen = false;             // Mark entrance gate as closed
        }
    }

    // Function to handle the exit gate operation
    void handleExitGate() {
        int exitState = digitalRead(exitSensor);
        
        // Check exit sensor
        if (exitState == LOW && !exitGateOpen) {
            openExitGate();      // Open exit gate if triggered and not already open
        }

        // Close exit gate after 3 seconds
        if (exitGateOpen && millis() - exitOpenTime > 3000) {
            servoExit.write(0);                   // Close exit gate
            exitGateOpen = false;                 // Mark exit gate as closed
        }
    }

    // API for sensor states
    void handleSensorAPI() {
        String path = webServer.uri();
        int sensorIndex = path.substring(2).toInt() - 1;  // Extract sensor number (adjusted for zero-based indexing)
        
        Serial.println("Sensor Index: " + String(sensorIndex)); // Debugging line

        // Set CORS headers
        webServer.sendHeader("Access-Control-Allow-Origin", "*");
        webServer.sendHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
        
        // Create a JSON object to respond with
        StaticJsonDocument<200> jsonDoc;

        if (sensorIndex >= 0 && sensorIndex <= 3) {
            int sensorState = digitalRead(slotSensors[sensorIndex]);
            jsonDoc["status"] = "success";
            jsonDoc["sensorState"] = sensorState;  // Return sensor state
        } else {
            jsonDoc["status"] = "error";
            jsonDoc["message"] = "Sensor not found";
        }

        // Convert JSON object to string
        String response;
        serializeJson(jsonDoc, response);
        
        // Send the JSON response
        webServer.send(200, "application/json", response);
    }

    void setup() {
        Serial.begin(9600);

        // Initialize sensors
        for (int i = 0; i < 4; i++) {
            pinMode(slotSensors[i], INPUT_PULLUP);
        }
        pinMode(entranceSensor, INPUT_PULLUP);
        pinMode(exitSensor, INPUT_PULLUP);

        // Initialize servo motors
        servoEntrance.attach(servoEntrancePin);
        servoExit.attach(servoExitPin);
        servoEntrance.write(0); // Initial position
        servoExit.write(0);     // Initial position

        // Set up WiFi and DNS server
        WiFi.softAPConfig(apIP, apIP, IPAddress(255, 255, 255, 0));
        WiFi.softAP(ssid);
        dnsServer.start(53, "*", apIP);

        // Setup web server routes dynamically
        for (int i = 1; i <= 4; i++) {
            webServer.on("/d" + String(i), handleSensorAPI);
        }
        webServer.on("/open/entrance", []() {
            openEntranceGate();
            // Set CORS headers
            webServer.sendHeader("Access-Control-Allow-Origin", "*");
            webServer.send(200, "application/json", "{\"status\":\"success\",\"message\":\"Entrance gate opened\"}");
        });
        webServer.on("/open/exit", []() {
            openExitGate();
            // Set CORS headers
            webServer.sendHeader("Access-Control-Allow-Origin", "*");
            webServer.send(200, "application/json", "{\"status\":\"success\",\"message\":\"Exit gate opened\"}");
        });
        webServer.begin();
    }

    void loop() {
        dnsServer.processNextRequest();
        webServer.handleClient();
        handleExitGate();
        handleEntranceGate();
    }
