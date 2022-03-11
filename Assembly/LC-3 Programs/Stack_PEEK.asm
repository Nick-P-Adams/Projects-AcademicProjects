;Nick Adams
;CSCD 260 Lab 8 PEEK
;Small program below is a stack that implements PEEK 
;I will use R0 to store the returned value from PEEK Examples in Lab 8 PDF
.ORIG x3000
AND R6 R6 #0 ;Clear R6 to be used as stack pointer
AND R0 R0 #0 ;Clear R0 for use by functions
LD R6 START ;Loading R6 with the start of the stack

ADD R0 R0 #5
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #2
JSR PUSH

AND R0 R0 #0 ;Clear R0 for use by functions
ADD R0 R0 #4
JSR PUSH ;I am pushing 3 numbers into the stack 

AND R0 R0 #0 ;Clear R0 for use by functions
JSR PEEK

AND R0 R0 #0 ;Clear R0 for use by functions
JSR PEEK ;PEEKing twice to show the number is not changed only outputed to R0

AND R0 R0 #0 ;Clear R0 for use by functions
JSR PEEK2 

AND R0 R0 #0 ;Clear R0 for use by functions
JSR PEEK2 ;PEEKing twice to show the number is not changed only outputed to R0

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; The section below is for functions
POP     AND R5 R5 #0 ;CLearing R5 to indicate possible failure
        LD R1 EMPTY ;Loading R1 with -x4000 to detect underflow
        ADD R2 R6 R1 ;Results of this operations will detect underflow
        BRz FAIL ;If test fails we take FAIL branch
    
        LDR R0 R6 #0 ;Loads popped value into R0
        ADD R6 R6 #1 ;Increment our pointer to free up a memory location in the stack
        BRnzp SUCCESS ;If we make it here then we take the SUCCESS branch
        
PEEK    AND R5 R5 #0 ;CLearing R5 to indicate possible failure
        ST R7 Save7 ;Save the previous return address
        JSR POP ;Pop value from top of stack to be viewed
        JSR PUSH ;Pushes the value back into the stack
        LD R7 Save7 ;Once both push and pop are successful return to the program that called PEEK
        JMP R7
        ;As long as POP is successful PUSH will be successful as well
PEEK2
        AND R5 R5 #0 ;Clearing R5 to indicate possible failure
        LD R1 EMPTY ;Loading R1 with -x4000 to detect underflow
        ADD R2 R6 R1 ;Results of this operations will detect underflow
        BRz FAIL ;If test fails we take FAIL branch
        
        LDR R0 R6 #0 ;In this version of PEEK we just store the value at the top of the stack. Also if we made it here then the stack is not empty.
        BRnzp SUCCESS ;Head to success
        
    
PUSH    AND R5 R5 #0 ;CLearing R5 to indicate possible failure
        LD R1 MAX ;Loading R1 with -x3FFB to detect overflow
        ADD R2 R6 R1 ;Results of this operation will detect overflow
        BRz FAIL ;If test fails we take FAIL branch
        
        ADD R6 R6 #-1 ;First we decrement the pointer that way we can add a value to the next empty memory location
        STR R0 R6 #0 ;Stores the value from R0 in the empty stack memory location 
        
SUCCESS JMP R7 ;Return to the caller program

FAIL    ADD R5 R5 #1 ;This indicates Failure 
        JMP R7 ;Return to caller program
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 

HALT

START .FILL x4000 ;The stack will be empty by default 
Save7 .FILL #0 ;For saving return address
;Values for functions to load out of memory below
MAX .FILL xC005 ;This is -x3FFB to compare with pointer and detected Overflow
EMPTY .FILL xC000 ;This is -x4000 to compare with pointer and detect Underflow
.END