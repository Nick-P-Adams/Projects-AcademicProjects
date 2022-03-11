;LC-3 Program Lab Manuel 4 Fibonacci
;Course: CSCD 260 Machine Orgaanization 
;Section: 01
;Term: Spring 2021
;Instructor: Nancy Ripplinger
;Lab4: Fibonnacci Number
;Define exactly what Fibonacci sequence is from wiki assignment.

;Description:
;   This program implements the fibonaacci sequence.
;   The program will compute the nth fibonacci number Fn, and 
;   the greaatest fibonacci number FibN that can be represented
;   in 16 bit two's complement format. If Fn
;   becomes to larage, it won't be able to be represented in 
;   16 bits, and an overflow will occur, in which the bits 
;   overlap the sign bit causing the value to become a negative.
;   
;   The input will be an integer (n) found at location x3100.
;   The output will be found at x3101, x3102, and x3103. Fn
;   will be stored in location x 3101. The Nth number will be 
;   stored in x3102. The FN will be stored in x3103.

.ORIG x3050

ADD R1 R1 #15 
ADD R1 R1 #4 ;Delete the semicolon in front of ADD on this line in order to make the value 19. The default is value n = 15
ST R1 n ;Store our value for n in the memory location set aside for it
;Store n into register R1 (NOTE: also store it into the memory x3100
;if the program asked for input instead of using it straight from x3100)

;Initialize other data values:
;R2 and R3 are used to store n-1 and n-2 (and the initial values for n=1 and n=2)
AND R2 R2 #0
AND R3 R3 #0 ;Clearaing R2 and R3 to be used as n-1 and n-2
ADD R2 R2 #1
ADD R3 R3 #1 ;Initializing both to their starting values.

;R4 is used to store current fib number
AND R4 R4 #0 ;Clearing R4 to be used to store the current fib number

;R5 is used as the counter for the current number
AND R5 R5 #0 ;Clearaing R5 to be used as a sentinel/ current fib number
ADD R5 R5 #2 ;Setting up with value 2 to indicate first two numbers are known. 
;Note: in this case, counter starts at 2, since n=1 aand n=2 are known

ADD R0 R1 #-3
BRn nth_FIB_FOUND
;Check if n < 3
;If true, do not enter the loop
FIND_nth_FIB
;Find the nth fib

NOT R1 R1 
ADD R1 R1 #1 ;Make the value of n stored in R1 negative so we can subtract from the counter 
ADD R1 R5 R1 ;Subtracting n from the counter to see if we should stop the loop
BRzp nth_FIB_FOUND
LD R1 n ;Reloaad R1 with value n
;compare the counter against n
;(Ex. by subtracting the counter from n)
;continue loop if counter < n

ADD R5 R5 #1 ;Incrementing the counter
ADD R4 R2 R3 ;Adding two previous values to find our current value
ADD R2 R3 #0 ;Moving value of R3 down to R2 
ADD R3 R4 #0 ;Moving the value from R4 down to R3 in order to calculate the next current value.
;Compute the next fib number (add two pervious values, store into R4)
;Increment the counter
;R2 = R3
;R3 = R4
BR FIND_nth_FIB

;If n < 3 then jump straight to here 
nth_FIB_FOUND

ST R4 Fn ;Storing nth Fibb number into Fn memory location
;once the nth fib found.
;Store the nth fibonacci number into Fn

;Always perfrom this loop 
FIND_LARGEST_FIB
;find the largest fib

ADD R5 R5 #1 ;Incrementing the counter
ADD R4 R2 R3 ;Adding two previous values to find our current value
ADD R2 R3 #0 ;Moving value of R3 down to R2 
ADD R3 R4 #0 ;Moving the value from R4 down to R3 in order to calculate the next current value.

AND R6 R6 #0 ;Clearing R6 to hold the results of our overflow check
NOT R6 R4
ADD R6 R6 #1 ;If result is postitive then it means our current fibb number came out negative and overflow has occured. We have found the largest number.
BRp LARGEST_FOUND
;Compute next fib number
;Check if the fib is negative (bit 16 = 1)
;That means it is an overflow.
;If fib is not negaative, continue the loop

;Set R2 = R3
;Set R3 = R4
;Increment the counter
BR FIND_LARGEST_FIB

;Once overflow occured - largest FIB is found
LARGEST_FOUND

ADD R5 R5 #-1
ST R5 nn
ST R2 Fnn ;Storing the values in their proper memory locations
;The largest fib found. Store the value
;NOTE: R4 is holding the overflow value, that is not the answer. FN is R3 (previous value)
;NOTE: the counter holds the value for the overflown. N is counter - 1

;Store the counter
;Store the Nth fibonacci number

HALT

;The storage locations for values 
n .FILL x3100
Fn .FILL x3101
;Had issues assembling using N and FN so now they are nn and Fnn
nn .FILL x3102
Fnn .Fill x3103
.END