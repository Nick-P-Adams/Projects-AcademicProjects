import java.io.File;
import java.io.IOException;
import java.util.Scanner;

public class FastMatrixMulti 
{
	private int bracketPosition[][];
	
	public static void main(String[] args) 
	{
		try
		{
			int lineCount = 0;
			File file = new File(args[0]);
			Scanner fs = new Scanner(file);
			FastMatrixMulti fmm = new FastMatrixMulti();
			
			while(fs.hasNext())
			{
				lineCount++;
				fs.next();
			}
			fs.close();
			fs = new Scanner(file);
			int matrixDimensions[] = new int[lineCount];
		
			for(int i = 0; i < lineCount; i++)
			{
				matrixDimensions[i] = fs.nextInt();
			}
			
			System.out.println(fmm.matrix_Chain_Order(matrixDimensions));
			fmm.print_Optimal_Parens(1, matrixDimensions.length - 1);
		}
		catch (IOException e)
		{
			e.printStackTrace();
		}
		
		


	}
	
	private int matrix_Chain_Order(int p[])
	{
		int n = p.length;
		int optimalTime[][] = new int[n][n]; 
		this.bracketPosition = new int[n][n];
		
		for(int i = 1; i < n; i++)
		{
			optimalTime[i][i] = 0;
		}
		
		for(int h = 2; h < n; h++)
		{
			for(int i = 1; i < n - h + 1; i++)
			{
				int j = i + h - 1;
				
				optimalTime[i][j] = Integer.MAX_VALUE;
				
				for(int k = i; k <= j - 1; k++)
				{
					int q = optimalTime[i][k] + optimalTime[k + 1][j] + p[i - 1]*p[k]*p[j];
					
					if(q < optimalTime[i][j])
					{
						optimalTime[i][j] = q;
						this.bracketPosition[i][j] = k;
					}
				}
			}
		}
		return optimalTime[1][n-1];
	}
	
	private void print_Optimal_Parens(int i, int j)
	{
		if(i == j)
		{
			System.out.print("A" + i);
		}
		else
		{
			System.out.print("(");
			this.print_Optimal_Parens(i, this.bracketPosition[i][j]);
			this.print_Optimal_Parens(this.bracketPosition[i][j] + 1, j);
			System.out.print(")");
		}
	}
}
