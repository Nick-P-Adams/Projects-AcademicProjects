;Nick Adams
;CSCD 260 Lab02 - Arithmetic Functions
.ORIG x3050

;Load the X and Y values
AND R1 R1 #0 ;Clearing R1 for X
AND R2 R2 #0 ;Clearing R2 for Y
LD R1 X
LD R2 Y

;Calculate X - Y and then store at x3122
;Clear R3
;Flip Y
;Finish 2's comp
;Add X with -Y
;Store at x3122
AND R3 R3 #0 ;Clearing R3 for result of X - Y
NOT R2 R2 ;Flip y 
ADD R2 R2 #1 ;Add 1 so we get -Y
ADD R3 R1 R2 ; X - Y
ST R3 XsubY ;Storing result at XsubY 

;Calculate |X| and then store at x3123
;Clear R3
;Move the value X to R3
;Do not negate if zero or positive
AND R3 R3 #0 ;Clearing R3 for |X|
ADD R3 R1 #0 ;Moving X to R3
BRzp CONTINUEX ;If result is zero or positive it is ready to be stored if not we take the branch and convert to positive number first. 

;Flip X!
;Do 2's complement to R3 (|X|)
NOT R3 R3 ;Flipping X 
ADD R3 R3 #1 ;Adding 1 to make it the positive version of X

CONTINUEX
;Store at x3123
ST R3 absX ;Storing our absolute value of X

; Calculate |Y| and then store at x3124
; Clear R4
; Move the value Y to R4
; Do not negate if zero or positive
AND R4 R4 #0 ;Clearing R4 for |Y|
ADD R4 R2 #0 ;Moving Y to R4
BRzp CONTINUEY ;If result is zero or positive it is ready to be stored if not we take the branch and convert to positive number first.

; Flip Y
; Do 2's complement to R4 (|Y|)
NOT R4 R4 ;Flipping Y 
ADD R4 R4 #1 ;Adding 1 to make it the positive version of Y

CONTINUEY
;Store at x3124
ST R4 absY ;Storing our absolute value of X

;Calculate and store Z at x3125
;Z is  1 if |X| - |Y| > 0,
;      2 if |X| - |Y| < 0,
;      0 if |X| - |Y| = 0
;(|X| is R3, |Y| is R4)
;Clear R5
;Clear R6
AND R5 R5 #0
AND R6 R6 #0 ;CLearing all the relavent registers for use R6 is effectivley our Z 

;Copy |Y| to R5
;Flip |Y|
;Complete 2's comp to make R5 into -|Y|
ADD R5 R4 #0 ;Moving abs Y into R5
NOT R5 R5
ADD R5 R5 #1 ;Converting to -|Y|

; Add |X| and -|Y|
ADD R5 R3 R5
BRz DONE ;If result is 0 then skip straight to done
BRp POSZ ;If result is positive then call POSZ branch
BRn NEGZ ;If result is negative then call NEGZ branch

; branching
; Z is already at 0, so we do nothing if the difference is 0

POSZ
ADD R6 R6 #1
BR DONE

NEGZ
ADD R6 R6 #2
BR DONE

DONE
ST R6 Z

HALT
.END

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; Test Cases Below
.ORIG x3120

; TIP!
; Highlight and press ctrl /
; to uncomment/comment the test
; cases you would like to use


;   (10, 20)
;X .FILL #10
;Y .FILL #20

;   (-11, 15)
;X .FILL #-11
;Y .FILL #15

;   (11, -15)
;X .FILL #11
;Y .FILL #-15

;   (12, 12)
X .FILL #12
Y .FILL #12

XsubY   .FILL #0  
absX    .FILL #0  
absY    .FILL #0  
Z       .FILL #0 
.END