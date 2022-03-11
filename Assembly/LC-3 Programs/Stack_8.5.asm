;Nick Adams
;CSCD 260 Lab 8 exercise 8.5
;Implementing the stack in figure 8.8
.ORIG x3000
AND R6 R6 #0 ;Clear R6 to be used as pointer to top of the stack
AND R4 R4 #0 ;Clearing R4 to be used as special pointer
AND R0 R0 #0 ;Clear R0 for use by functions
LD R6 TOP ;Loading R6 with the top of the stack

ADD R0 R0 #5
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #2
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #4
JSR PUSH 

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #3
JSR PUSH 

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #6
JSR PUSH 

JSR POP
JSR POP

BR DONE
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; The section below is for functions
POP     AND R5 R5 #0 ;CLearing R5 to indicate possible failure
        AND R1 R1 #0 ;Clearing R1 to assit in moving values
        LD R2 SIZE
        BRnz FAIL
        
        LDR R0 R6 #0 ;Popping top of the stack to R0
        ADD R2 R2 #-1 ;Reducing size by 1
        ST R2 SIZE ;Storing the new reduced stack size for later use
        ADD R3 R2 #0 ;Setting up our Sentinel value incase the stack was larger than size 1
        BRz SUCCESS ;If we get a 0 at this point it means the stack was at size 1 and reduced to 0 which means there are no elments to move around go straight to success
        
        POP_LOOP    ST R6 PREVADD ;Storing where top pointer was before it gets incremented
                    ADD R6 R6 #1 ;Incrementing the top pointer
                    LDR R1 R6 #0 ;Loading the value from top pointers new position into R1 to be moved up
                    STR R1 R6 #-1 ;Storing the value in R1 into a memory location one above the current top
                    ADD R3 R3 #-1 ;Decrementing our sentinel
                    BRp POP_LOOP
        
        LD R6 TOP ;Set the top back to the top memory address
        LD R4 PREVADD ;Setting our bottom to the bottom of the stack
        BR SUCCESS
        
PUSH    AND R5 R5 #0 ;CLearing R5 to indicate possible failure
        LD R1 MAXSIZE ;Loading R1 with max size to detect overflow 
        LD R2 SIZE ;Loading R2 with the current size 
        ADD R1 R1 R2 ;If result is negative we still have room if the result is >= zero then we have overflow
        BRzp FAIL
        
        ADD R2 R2 #0 ;Checking to see if the size of the stack is Zero that way the loop can be avoided
        BRz ZERO
        
        AND R3 R3 #0 ;Clearing R3 to be used as a sentinel
        ADD R3 R2 #0 ;The size of the stack will be our sentinel
        PUSH_LOOP    ST R4 PREVADD ;Storing the previous address of the bottom pointer 
                     LDR R5 R4 #0 ;Loading the bottom value into R5
                     ADD R4 R4 #1 ;Incrementing the bottom pointer down one to make space at the top
                     STR R5 R4 #0 ;Store the value at R5 into the new bottom position in the stack
                     LD R4 PREVADD ;Loading R4 with it's previous address 
                     ADD R4 R4 #-1 ;Decrementing R4 by one 
                     ADD R3 R3 #-1 ;Decrementing our sentinel value
                     BRp PUSH_LOOP
             
        ZERO    STR R0 R6 #0 ;Push R0 value into the top of the stack
                ADD R2 R2 #1 ;Increasing the size  by 1
                ST R2 SIZE ;Saving our size value back to SIZE memory loaction
                AND R3 R3 #0 ;Clearing R3 to store size - 1
                ADD R3 R2 #-1 ;Storing size - 1 into R3
                ADD R4 R6 R3 ;Setting the bottom pointer back to the bottom of the stack which is (top memory location) + (size - 1)
                AND R5 R5 #0 ;clearing R5 to be used again
        
SUCCESS JMP R7 ;Return to the caller program

FAIL    ADD R5 R5 #1 ;This indicates Failure 
        JMP R7 ;Return to caller program
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 

DONE HALT

TOP .FILL x4000 ;The stack will be empty by default 
SIZE .FILL #0 ;Stack is empty
MAXSIZE .FILL #-5;
PREVADD .FILL #0;
.END