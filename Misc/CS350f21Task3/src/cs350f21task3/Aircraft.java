package cs350f21task3;

public class Aircraft 
{
	private String id;
	private State state;
	
	public Aircraft(String id, State state)
	{
		this.id = id;
		this.state = state;
	}
	
	public void update()
	{
		this.state.update();
	}
	
	public String getID() {return this.id;}
	public State getState() {return this.state;}
}
