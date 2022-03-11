package cs350f21task3;

public class State 
{
	private double x, y, z;
	private double heading, headingTarget, turnRate, turnSoFar, distance; 
	private double speedHorizontal, speedHorizontalTarget, speedVertical, accelerationHorizontal;
	private boolean direction;
	
	public State(double x, double y, double z, double heading, double speedHorizontal, double speedVertical, double accelerationHorizontal, double turnRate)
	{
		this.x = x;
		this.y = y;
		this.z = z;
		this.heading = heading;
		this.headingTarget = heading;
		this.direction = true;
		this.speedHorizontal = speedHorizontal;
		this.speedHorizontalTarget = speedHorizontal;
		this.speedVertical = speedVertical;
		this.accelerationHorizontal = accelerationHorizontal;
		this.turnRate = turnRate;
		this.turnSoFar = 0;
		this.distance = this.findDistance();
	}
	
	public void update()
	{
		this.updateSpeedHorizontal();
		this.updateHeading();
		this.updatePosition();
	}
	
	private void updateHeading()
	{
		if(this.heading != this.headingTarget)
		{
			this.heading += ((this.direction) ? 1:-1) * this.turnRate;
			this.heading = this.normalizeHeading(this.heading);
			this.turnSoFar += this.turnRate;
			
			if(this.turnSoFar >= this.distance)
			{
				this.headingReached();
			}
		}
	}
	
	private double findDistance()
	{
		if(this.direction)
		{
			return this.normalizeHeading((this.headingTarget - this.heading));
		}
		else
		{
			return this.normalizeHeading((this.heading - this.headingTarget));
		}
	}
	
	private double normalizeHeading(double heading)
	{
		double normalized = heading % 360;
		
		if(normalized < 0)
		{
			normalized += 360;
		}
		
		return normalized;
	}
	
	private void headingReached()
	{
		this.heading = this.headingTarget;
		this.turnSoFar = 0;
	}
	
	private void updateSpeedHorizontal()
	{
		if(this.speedHorizontal != this.speedHorizontalTarget)
		{
			if(this.speedHorizontal < this.speedHorizontalTarget)
			{
				this.speedHorizontal += this.accelerationHorizontal;
				
				if(this.speedHorizontal > this.speedHorizontalTarget)
				{
					this.horizontalSpeedReached();
				}
			}
			else
			{
				this.speedHorizontal -= this.accelerationHorizontal;
				
				if(this.speedHorizontal < this.speedHorizontalTarget)
				{
					this.horizontalSpeedReached();
				}
			}
		}
	}
	
	private void horizontalSpeedReached()
	{
		this.speedHorizontal = this.speedHorizontalTarget;
	}
	
	private void updatePosition()
	{
		this.x += this.speedHorizontal * Math.sin(Math.toRadians(this.heading));
		this.y += this.speedHorizontal * Math.cos(Math.toRadians(this.heading));
		this.z += this.speedVertical;
	}
	
	public double getX() {return this.x;}
	public double getY() {return this.y;}
	public double getZ() {return this.z;}
	public double getAccelerationHorizontal() {return this.accelerationHorizontal;}
	public double getSpeedHorizontal() {return this.speedHorizontal;}
	public double getSpeedHorizontalTarget() {return this.speedHorizontalTarget;}
	public double getSpeedVertical() {return this.speedVertical;}
	public double getHeading() {return this.heading;}
	public double getHeadingTarget() {return this.headingTarget;}
	public boolean getHeadingTargetDirection() {return this.direction;}
	public double getTurnRate() {return this.turnRate;}
	public String getStateCSV() {return this.x + "," + this.y + "," + this.z + "," + this.heading + "," + this.speedHorizontal + "," + this.speedVertical;}
	
	public void setHeadingTarget(double heading, boolean direction) {this.headingTarget = heading; this.direction = direction; this.turnSoFar = 0; this.distance = this.findDistance();}
	public void setSpeedHorizontalTarget(double horizontalSpeed) {this.speedHorizontalTarget = horizontalSpeed;}
	public void setSpeedVertical(double verticalSpeed) {this.speedVertical = verticalSpeed;}
}
