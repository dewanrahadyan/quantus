/*
 * Available information:
 * 1. Request queue
 * Simulator.get_instance().get_requests()
 * Array of integers representing floors where there are people calling the elevator
 * eg: [7,3,2] // There are 3 people waiting for the elevator at floor 7,3, and 2, in that order
 * 
 * 2. Elevator object
 * To get all elevators, Simulator.get_instance().get_building().get_elevator_system().get_elevators()
 * Array of Elevator objects.
 * - Current floor
 * elevator.at_floor()
 * Returns undefined if it is moving and returns the floor if it is waiting.
 * - Destination floor
 * elevator.get_destination_floor()
 * The floor the elevator is moving toward.
 * - Position
 * elevator.get_position()
 * Position of the elevator in y-axis. Not necessarily an integer.
 * - Elevator people
 * elevator.get_people()
 * Array of people inside the elevator
 * 
 * 3. Person object
 * - Floor
 * person.get_floor()
 * - Destination
 * person.get_destination_floor()
 * - Get time waiting for an elevator
 * person.get_wait_time_out_elevator()
 * - Get time waiting in an elevator
 * person.get_wait_time_in_elevator()
 * 
 * 4. Time counter
 * Simulator.get_instance().get_time_counter()
 * An integer increasing by 1 on every simulation iteration
 * 
 * 5. Building
 * Simulator.get_instance().get_building()
 * - Number of floors
 * building.get_num_floors()
 */

Elevator.prototype.decide = function() {
    {
    init: function (elevators, floors) {

        var pickUpChance = 1.0;  //  This var means the probability that elevator stops to pick up pax on middle floors.
        // In different cases try value from 0.4 (usually for Speed levels) to 1.0 (usually for levels with waiting time limit).

        var isPressedUp = [];    // Index of array means number of a floor where the button was pressed.
        var isPressedDown = [];

        function ensureDirection(objElevator) {
            if (objElevator.goingUpIndicator()) {
                if (objElevator.currentFloor() >= Math.max.apply(null, objElevator.destinationQueue)) {
                    objElevator.goingUpIndicator(false);
                    objElevator.goingDownIndicator(true);
                    objElevator.goToFloor(0);
                }
            }
            if (objElevator.currentFloor() === 0) {
                objElevator.goingUpIndicator(true);
                objElevator.goingDownIndicator(false);
                //objElevator.goToFloor(floors.length - 1)  //Uncomment this line for 18th level. (Just a little spike)
            }
        }

        function sortQueue(objElevator) {
            if (objElevator.goingUpIndicator()) {
                objElevator.destinationQueue.sort(function (a, b) {
                    return a - b;
                });
            } else {
                objElevator.destinationQueue.sort(function (a, b) {
                    return b - a;
                });
            }
            objElevator.checkDestinationQueue();
        }

        function callFreeElevator(floorNum) {
            for (i = 0; i < elevators.length; i++) {
                if (elevators[i].destinationQueue.length === 0) {
                    elevators[i].goToFloor(floorNum);
                    isPressedDown[floorNum] = false;
                    break;
                }
            }
        }

        function findHighestPaxAndGo(objElevator){
            for (floorNum = floors.length - 1; floorNum >= 0; floorNum--) {
                if (isPressedUp[floorNum] || isPressedDown[floorNum]) {
                    objElevator.goToFloor(floorNum);
                    isPressedUp[floorNum] = false;
                    isPressedDown[floorNum] = false;
                    break;
                }
            }
        }


        elevators.forEach(function (elevator) {

            elevator.goingUpIndicator(true);
            elevator.goingDownIndicator(false);

            // Whenever the elevator is idle
            elevator.on("idle", function () {
              findHighestPaxAndGo(this);
            });

            elevator.on("floor_button_pressed", function (floorNum) {
                this.goToFloor(floorNum);
                ensureDirection(this);
                sortQueue(this);
            });


            elevator.on("stopped_at_floor", function (floorNum) {
                ensureDirection(this);
                sortQueue(this);
                if (this.goingUpIndicator()) {
                    isPressedUp[floorNum] = false;
                } else {
                    isPressedDown[floorNum] = false;
                }
            });

            //Pick up pax on middle floors
            elevator.on("passing_floor", function (floorNum, direction) {
                if (direction === 'up' && isPressedUp[floorNum] && this.loadFactor() < 0.7) {
                    this.goToFloor(floorNum, true);
                    isPressedUp [floorNum] = false;

                }
                else if (direction === 'down' && isPressedDown[floorNum] && this.loadFactor() < 0.7 &&
                    Math.random() < pickUpChance) {   // Yeah man, elevator can doesn't stop for you if you aren't lucky enough.
                    this.goToFloor(floorNum, true);
                    isPressedDown [floorNum] = false;
                }
            });
        });

        // Add event of pressed button on a floor in array of pressed buttons.
            floors.forEach(function(floor){
            floor.on("down_button_pressed", function () {
                isPressedDown[this.floorNum()] = true;
                callFreeElevator(this.floorNum());
            });
            floor.on("up_button_pressed", function () {
                isPressedUp[this.floorNum()] = true;
            });
        });
    }
,
    update: function (dt, elevators, floors) {
        // We normally don't need to do anything here
    }
}
};
