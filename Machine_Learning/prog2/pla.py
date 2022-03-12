# >>>>>>>>>>>>> Nick Adams 00883496


# Implementation of the perceptron learning algorithm. Support the pocket version for linearly unseparatable data. 



# NOTE: Your code need to vectorize any operation that can be vectorized. 


import numpy as np

class PLA:
    def __init__(self):
        self.w = None
        self.comparison_Vector = None
        
    def fit(self, X, y, pocket = True, epochs = 100):
        ''' X: n x d matrix, representing n samples, each has d features. It does not have the bias column. 
            y: n x 1 matrix of {+1, -1}, representing the n labels of the n samples in X.

            return: self.w, the (d+1) x 1 weight matrix representing the classifier.  

            1) if pocket = True, the function will run the pocket PLA and will update the weight
               vector for no more than epoch times.  

            2) if pocket = False, the function will run until the classifier is found. 
               If the classifier does not exist, it will run forever.             
        '''
        
        ### add your code here. 
        
        samples = np.insert(X, 0, 1, axis=1)
        self.w = np.zeros((len(samples[0]), 1))
        
        if pocket:
            while(self.error(samples, y) != 0 and epochs > 0):
                self._update_w(samples, y, pocket)
                epochs -= 1
        else:        
            while(self.error(samples, y) != 0):
                self._update_w(samples, y, pocket)
        
        # Hint: In practice, one will scan through the entire set to find the next misclassied sample. 
        #       One will repeatedly scan the data set until one scan does not see any misclassified sample. 
        
        #       Use matrix/vector operation in checking each training sampling. 
        
        #       In the pocket version, you can use the self.error function you will develop below. 
      
    
    def _update_w(self, samples, y, pocket):
        w = self.w
        for i in range(len(samples)):
            if(self.comparison_Vector[i] != y[i]):
                w = w + (y[i] * samples[i]).reshape(-1,1)
                
            if(pocket):
                temp = self.w
                initial_Error_Count = self.error(samples, y)
            
                self.w = w
                updated_Error_Count = self.error(samples, y)
        
                if(initial_Error_Count < updated_Error_Count):
                    self.w = temp
            else:
                self.w = w
                
                
    def predict(self, X):
        ''' 
            X: n x d matrix, representing n samples and each has d features, excluding the bias feature. 
            return: n x 1 vector, representing the n labels of the n samples in X. 
            
            Each label could be +1, -1, or 0. 
            
            Note: We let the users to decide what to do with samples 
                  that sit right on the classifier, i.e., x^T w = 0
        '''
        
        ### add your code here 
        
        if(self.w is None):
            print("No current model you must first use PLA.fit(X, y) to generate a model")
            return
        
        samples = np.insert(X, 0, 1, axis=1)
        
        return np.sign(samples @ self.w)
    
        # Hint: use matrix/vector operation to predict the labels of all samples in one shot of code. 
    
    
    def error(self, X, y):
        '''
            X: n x d matrix, representing n samples and each has d features, excluding the bias feature.
            y: n x 1 vector, representing the n labels of the n samples in X. Each label is +1 or -1. 
            
            return: the number of samples in X that are misclassified by the classifier
            
            Note: we count a sample x that sits right on the classifier, x^T w = 0, as a misclassified one. 
        '''
        
        # add your code here
        
        if(self.w is None):
            print("No current model you must first use PLA.fit(X, y) to generate a model")
            return
        
        if(len(X[0]) != len(self.w)):
            X = np.insert(X, 0, 1, axis=1)
            
        self.comparison_Vector = np.sign(X @ self.w)
        
        error_Vector = np.invert(self.comparison_Vector == y)
              
        return np.sum(error_Vector)
    
        # Hint: use matrix/vector operation to get predicated label vector in one shot of code. 
        #       Then use vector comparison to compare the given label vector and 
        #       the predicted label vector, along with the help from the numpy.sum function
        #       to count the #misclassified quickly. 

    