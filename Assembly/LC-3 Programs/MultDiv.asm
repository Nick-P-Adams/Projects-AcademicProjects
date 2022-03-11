;LC-3 Program Lab Manuel 5 Subroutines: Multiplication, Division, and Modulus
;Course: CSCD 260 Machine Orgaanization 
;Section: 01
;Term: Spring 2021
;Instructor: Nancy Ripplinger
;Lab5: Subroutines: Multiplication, Division, and Modulus

;Description:
;  Create subroutines that can handle Multiplication
;  Division and Modulus operations for some integer n.

.ORIG x3000
LD R0 X ;Loading R0 with address of X in memory
LDR R0 R0 #0 ;Loading X from the address we just loaded into R0

LD R1 Y ;Loading R1 with address of Y in memory
LDR R1 R1 #0 ;Loading Y from the address we just loaded into R1
;Load the X and Y valaues into the registers
;X in R0, Y in R1

;Jump to MULT subroutine
;Note: R7 holds the return value
JSR MULT
;Jumpt to DIVISION subroutine
JSR DIV

HALT

MULT
    ;Save the register R0 and R1 (if they will be used, if not - no need)
    ;Multiplication algorithm:
    ST R0 Save0
    ST R1 Save1
    
        ;Creatae a variable for the sign, initalize it to positive
        ;If X < 0, switch the sign, switch X to positive
        ;If Y < 0, switch the sign, switch Y to positive
    AND R3 R3 #0 ;Clearing R3 for use as the product sign
    ADD R3 R3 #1 ;Starting the sign as a positivie value
    ST R7 Save7
    ADD R0 R0 #0 ;Checking to see if X is negative
    BRzp CONTINUE1 ;If value is 0 or positive then skip past flipping the sign or making X positive it already is.
    
    NOT R0 R0 
    ADD R0 R0 #1 ;If X is negative we make it postive 
    JSR FLIP_SIGN ;Flip our product sign value
    
    CONTINUE1
    ADD R1 R1 #0 ;Checking to see if Y is negative
    BRzp CONTINUE2 ;If value is 0 or positive then skip past flipping the sign or making Y positive it already is.
    
    NOT R1 R1
    ADD R1 R1 #1 ;If Y is negative we make it postive
    JSR FLIP_SIGN ;Flip our product sign value
    
    CONTINUE2
    

        ;Initialize a register for the result (ex: R2)
    AND R2 R2 #0 ;Clearing R2 to be used for storing the product
        ;Loop, while Y doesn't equal 0:
            ;add X to prod
            ;decrement Y
    MULT_LOOP
            ADD R2 R0 R2 ;Adding X to product
            ADD R1 R1 #-1 ;Decrementing Y
            BRp MULT_LOOP
    
        ;if sign is negataive, switch the sign for prod
        ;NOTE: do not use TRAAP or JSR for the looping process. They will overwrtie the
        ;return address for the RET function. Using branching instructions.
    ;Store the product in x3102
    ;Restore R0 and R1 (if they changed)
    ;Return to the main program (using RET)
    ADD R3 R3 #0
    BRzp CONTINUE3
    JSR FLIP_PRODUCT_SIGN
    
    CONTINUE3
    
    LD R5 XY
    STR R2 R5 #0
    
    LD R0 Save0
    LD R1 Save1
    LD R7 Save7 ;Reload our lost return address into R7
    JMP R7
    
    FLIP_PRODUCT_SIGN
        NOT R2 R2
        ADD R2 R2 #1
        JMP R7 ;Flipping product sign value then returning 
    FLIP_SIGN
        NOT R3 R3
        ADD R3 R3 #1
        JMP R7 ;Flipping sign value then returning
DIV
    ;Save the register R0 and R1 (if you will reuse them, if not - no need)
    ST R0 Save0
    ST R1 Save1
    
    ADD R0 R0 #0
    BRn INVAL_INPUT ;Checking to see if X is greater than or equal to 0
    
    ADD R1 R1 #0 
    BRnz INVAL_INPUT ;Checking to see if Y is greater than 0
    
    AND R2 R2 #0 ;Clearing R2
    ADD R2 R2 #1 ;Setting R2 to 1
    ;Check if X >= 0 and Y > 0
    ;If it is, continue, set R2 to 1
    ;If it isn't branch to INVAL_INPUT
    ;Division algorithm:
        ;Initialize registers for quotient and remainder (ex: R3 and R4)
        ;Store X into aa temporary register (ex: R5)
    AND R3 R3 #0 ;CLearing R3 for use as Quotient
    AND R4 R4 #0 ;Clearing R4 for use as remainder
    AND R5 R5 #0 ;Clearing R5 for use as temporary value
    ADD R5 R0 #0 ;Storing X as temp value in R5
    
    NOT R1 R1
    ADD R1 R1 #1 ;Making Y negative since we know it has to be postive to have gotten this far
    
    DIV_LOOP
        ADD R3 R3 #1 ;Adding 1 to the quotient
        ADD R5 R5 R1 ;Subtracting Y from the temp value
        BRzp DIV_LOOP
                
        ;Loop, while temporary >= Y
            ;subtract Y from temporary value
            ;Add 1 to the quotient value
        ;The temporaray will hold the remainder after the loop ends, store it into Remaainder
    ;Store the Quotient and the Remainder in XdivY and XmodY
    ;Restore R0 and R1 (if they changed)
    ;Return to the main program (using RET)
    ADD R4 R5 #0 ;Moving remainder to the remainder register
    LD R6 Z ;Loading R6 with memory address for XdivY which I had to rename Z
    STR R3 R6 #0 ;Storing the Quotient in the Quotient memory location
    LD R6 XmodY ;Loading R6 with memory address for XmodY
    STR R4 R6 #0 ;Storing remainder into XmodY
    
    LD R0 Save0
    LD R1 Save1
    
    JMP R7
        
INVAL_INPUT
    ;Set R2 to 0
    ;Set XdivY, XmodY to 0
    ;Return to the main program (using RET)
    
    AND R2 R2 #0 ;Clearing R2 back to 0
    LD R3 Z ;Loding R3 with memory address for XdivY which had to be renamed Z 
    STR R2 R3 #0 ;Setting XdivY to 0
    LD R3 XmodY ;Loading R3 with memory address for XmodY
    STR R2 R3 #0 ;Setting XmodY to 0
    
    LD R0 Save0
    LD R1 Save1
    JMP R7
    
;NOTE: X and Y could be the storage locations for the subroutines for R0 and R1.
;Also, they will be useed if your program will ask for input rather than just use 
;the values in x3100 and x3101
Save0 .FILL #0
Save1 .FILL #0
Save7 .FILL #0
;Storage locations
X .FILL x3100
Y .FILL x3101
XY .FILL x3102
Z .FILL x3103 ;X divide Y for some reason the other label threw an error label cannot be a numeric value
XmodY .Fill x3104
.END