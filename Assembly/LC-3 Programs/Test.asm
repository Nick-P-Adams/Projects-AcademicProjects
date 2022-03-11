.ORIG x3000
                LEA R1, PROMPT
L1            LDR R0, R1, #0
                BRz FOO                    ;where FOO is some other routine.
L2            LDI R3, DSR
                BRzp L2
                STI R0, DDR
                ADD R1, R1, #1
                BR L1
FOO HALT 

DSR   .FILL xFE04
DDR   .FILL xFE06
PROMPT .STRINGZ "Hello World"
.END