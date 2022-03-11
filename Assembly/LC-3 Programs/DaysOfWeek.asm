;Class:CSCD 260 Lab 3 Days of the Week
;Section: 01
;Instructor: Nancy Ripplinger
;Name: Nick Adams
;Term:  Spring 2021
;Lab#3: Days of the week
;Description: Write a program in assembly that keeps prompting for an integer in the range 0-6, 
              ;and each time it outputs the corresponding name of the day.
              ;If a key other than '0' through '6' is pressed, the program exits

;Additional Description: 
              ;This program takes an input from user,
              ;checks if its 0 - 6, 
              ;then displays the corresponding day of week
              ;For the days of the week its starts with
              ;Sunday = 0, Monday = 1, all the way up to Saturday = 6

.ORIG x3000
RESTART LEA R0, PROMPT
        PUTS  
        GETC
        
        ADD R3 R0 #0
        ADD R3 R3 #-16
        ADD R3 R3 #-16
        ADD R3 R3 #-16
        
        ADD R2 R3 #0
        BRz SUNDAY
        ADD R2 R3 #-1
        BRz MONDAY
        ADD R2 R3 #-2
        BRz TUESDAY
        ADD R2 R3 #-3
        BRz WEDNESDAY
        ADD R2 R3 #-4
        BRz THURSDAY
        ADD R2 R3 #-5
        BRz FRIDAY
        ADD R2 R3 #-6
        BRz SATURDAY
        BR DONE
        
SUNDAY
LEA R0, SUN
PUTS
BR RESTART

MONDAY
LEA R0, MON
PUTS
BR RESTART

TUESDAY
LEA R0, TUE
PUTS
BR RESTART

WEDNESDAY
LEA R0, WED
PUTS
BR RESTART

THURSDAY
LEA R0, THU
PUTS
BR RESTART

FRIDAY
LEA R0, FRI
PUTS
BR RESTART

SATURDAY
LEA R0, SAT
PUTS
BR RESTART

DONE HALT

PROMPT .STRINGZ "Please Enter A Number: \n"
MON .STRINGZ "Monday\n"
TUE .STRINGZ "Tuesday\n"
WED .STRINGZ "Wednesday\n"
THU .STRINGZ "Thursday\n"
FRI .STRINGZ "Friday\n"
SAT .STRINGZ "Saturday\n"
SUN .STRINGZ "Sunday\n"
.END