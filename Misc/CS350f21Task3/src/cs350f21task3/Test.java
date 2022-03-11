package cs350f21task3;

public class Test {

	public static void main(String[] args) 
	{
		State state = new State(-1.1, -2.2, -3.3, 4.4, 5.5, 6.6, 1.7, 8.8);
		Aircraft ac = new Aircraft("DNR-1234", state);
		
		System.out.println("Update 1");
		System.out.println(ac.getState().getStateCSV() + "\n");
		
		for(int i = 0; i < 50; i++)
		{	
			if(i >= 4 && i < 9)
			{
				ac.getState().setHeadingTarget(90.0, true);
			}
			else if(i >= 9 && i < 14)
			{
				ac.getState().setSpeedVertical(-10.0);
			}
			else if(i >= 14 && i < 19)
			{
				ac.getState().setSpeedHorizontalTarget(50.0);
			}
			else if(i >= 19 && i < 29)
			{
				ac.getState().setHeadingTarget(100.0, false);
				ac.getState().setSpeedVertical(10.0);
			}
			else if(i >= 29 && i < 49)
			{
				ac.getState().setSpeedHorizontalTarget(1.0);
			}
			
			System.out.println("Update " + (i+2));
			//System.out.println(ac.getState().getStateCSV());
			ac.update();
			System.out.println(ac.getState().getStateCSV() + "\n");
		}
	}

}
