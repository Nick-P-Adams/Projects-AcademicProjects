;Nick Adams
;CSCD 260 Lab 8 8.6 
;implementing a stack that can push and pop two elements 
.ORIG x3000
AND R6 R6 #0 ;Clear R6 to be used as pointer to top of the stack
AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0 ;Clear R1 for use by functions with R0
LD R6 START ;Loading R6 with the top of the stack

ADD R0 R0 #5
ADD R1 R1 #4
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
ADD R0 R0 #2
ADD R1 R1 #1
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
ADD R0 R0 #7
ADD R1 R1 #6
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
ADD R0 R0 #10
ADD R1 R1 #9
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
JSR POP

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
JSR POP

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
JSR POP

AND R0 R0 #0 ;Clear R0 for use by functions
AND R1 R1 #0
JSR POP

BR DONE
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; The section below is for functions
POP ST R2 SaveR2 ;Saving whatever value is in R2 so that we can use it to detect underflow
    LD R2 Empty ;Empty <-- -x40000 
    ADD R2 R6 R2 ;Results of this operation will detect underflow
    BRz FAIL
    
    LDR R1 R6 #0 ;POP the first value
    LDR R0 R6 #1 ;POP the second value
    
    ADD R6 R6 #2 ;Move the pointer 2 memory locations to the new top of the stack
    AND R5 R5 #0 ;clearing R5 to show success
    LD R2 SaveR2 ;Reloading R2 with SaveR2 value
    JMP R7 ;Returning to the calling program
        
PUSH  ST R2 SaveR2 ;Saving whatever value is in R2 so that we can use it to detect overflow
      LD R2 MAX ;Setting R2 to the max stack memory location
      NOT R2 R2 ;Start of the two step process to convert R2 to it's negative equivalent
      ADD R2 R2 #1 ;R2 = -addr of stackmax
      ADD R2 R6 R2 ;This opertion will detect wether or not there is overflow
      BRz FAIL
      
      STR R0 R6 #-1 ;Pushing R0 into the stack
      STR R1 R6 #-2 ;Pushing R1 one above the value we just pushed into the stack
      
      ADD R6 R6 #-2 ;Setting our top pointer back to the top of the stack
      AND R5 R5 #0 ;Clearing R5 to indicated success
      LD R2 SaveR2 ;Reloading R2's previous value
      JMP R7 ;Return to calling program

FAIL    AND R5 R5 #0
        ADD R5 R5 #1 ;Adding 1 to R5 to indicate failure
        LD R2 SaveR2
        JMP R7
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 

DONE HALT

START .FILL x4000
MAX .FILL x3FFA
EMPTY .FILL xC000
SaveR2 .FILL x0000
.END