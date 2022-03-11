;Nick Adams
;CSCD 260 Lab 8 8.7 
;implementing a stack that can push and pop elements of arbitrary sizes. 
.ORIG x3000
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; The section below is for functions
POP ST R2 Save2 ;R2 is needed by POP 
    ST R1 Save1
    ST R0 Save0
    
    LD R1 BASE ;BASE contains -x3FFF
    ADD R1 R1 #-1 ; R1 contains -x4000
    ADD R2 R6 R1 ;Compare stack pointer to x4000
    BRz FAIL ;Fail if the stack is empty underflow has occured
    
    ADD R0 R4 #0
    ADD R1 R3 #0
    ADD R5 R6 R3
    ADD R5 R5 #-1
    ADD R6 R6 R3
    
    POP_LOOP LDR R2 R5 #0
             STR R2 R0 #0
             ADD R0 R0 #1
             ADD R5 R5 #-1
             ADD R1 R1 #-1
             BRp POP_LOOP
             BRnzp SUCCESS
        
PUSH ST R2 Save2 ;Save registers that are needed by PUSH
     ST R1 Save1
     ST R0 Save0
     
     LD R1 MAX ;MAX contains -x3FFB
     ADD R2 R6 R1 ;Compare stack pointer to -x3FFB
     BRz FAIL ;Fail if stack is full then overflow has occured
     
     ADD R0 R4 #0 ;Putting the location to push from or pop too into R0
     ADD R1 R3 #0 ;Putting the element size into R1
     ADD R5 R6 #-1 ;Setting R5 to one memory location above R6
     
     NOT R2 R3 ;Not R3 then storing in R2
     ADD R2 R2 #1 ;Completing the process giving us a negative version of the value in R3 stored in R2
     ADD R6 R6 R2 ;Move the pointer to it's new location which is in the negative direction the same as element size.
     
     PUSH_LOOP LDR R2 R0 #0 ;Changing R2 to the value from R0 which is the location to push from or pop too
               STR R2 R5 #0 ;Storing the value in R2 to memory address contained in R5
               ADD R0 R0 #1 ;incrementing R0 which is the location from where to push or pop.
               ADD R5 R5 #-1 ;Decrementing the pointer so we can store the next value
               ADD R1 R1 #-1 ;Keeping track of remaning elements to be added
               BRp PUSH_LOOP
               
SUCCESS LD R0 Save0
        LD R1 Save1 ;Restore original values
        LD R2 Save2
        
        AND R5 R5 #0 ;Success
        JMP R7 ;Return to calling program

FAIL    LD R0 Save0
        LD R1 Save1 ;Restore original values
        LD R2 Save2
        
        AND R5 R5 #0
        ADD R5 R5 #1 ;Failure
        JMP R7 ;Return to calling program
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 

DONE HALT

BASE .FILL xC001
MAX .FILL xC005
Save0 .FILL x0000
Save1 .FILL x0000
Save2 .FILL x0000
.END