.ORIG x3000
    LD R1, NUM ;loaading value NUM into R1
    AND R3 R3 #0 ; Clearaing R3 to be used as an outer loop counter. 
    AND R4 R4 #0 ; Clearing R4 for use as count of 1's
    ADD R3 R3 #15 ;We want the outer loop to run for the max number of bits 16 times.
    
OUTER_LOOP   
    AND R2, R2, #0      ; Clearing R2 so that it can store our divided number
    AND R5 R5 #0        ; Clearing R4 to store the value from checking our right most bit
    AND R5 R1 #1        ; Checking the right most bit 
    BRnz SHIFT_RIGHT_LOOP ; Skip incrementing R4 if the right most bit is not a 1
    ADD R4 R4 #1        ; Increment our 1's count
    
    SHIFT_RIGHT_LOOP       
            ADD R1, R1, #-2     ; Subtract 2 from the value stored in R1 (This loop is essentially diving our number by 2)
            BRn SRL_END         ; Exit the shift right loop when the value in R1 is negative
            ADD R2, R2, #1      ; Add 1 to the bit counter
            BR SHIFT_RIGHT_LOOP ; Start the loop over again we only exit once R1 becomes negaative
    SRL_END

    AND R1 R1 #0 ; Clearing R1 to be used again with our newly divided number 
    ADD R1 R1 R2 ; Storing the divided number into R1

    ADD R3 R3 #-1 ; Decrementing outer loop counter
    BRzp OUTER_LOOP

HALT
NUM .FILL #4976
.END