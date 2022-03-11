package atcsim.loader.navaid;

import java.io.IOException;
import java.util.Map;
import java.util.Scanner;

import atcsim.datatype.*;
import atcsim.graphics.view.navigation.OverlayNavigation;
import atcsim.loader.A_Loader;
import atcsim.world.navigation.A_ComponentNavaid;
import atcsim.world.navigation.ComponentNavaidILS;
import atcsim.world.navigation.NavaidILSBeaconDescriptor;

public class LoaderILS extends A_Loader 
{
	public LoaderILS(Map <String, A_ComponentNavaid<?>> navaids, OverlayNavigation overlay) 
	{
		super(navaids, overlay);
	}

	@Override
	public void load(Scanner scanner) throws IOException 
	{
		String nextLine = scanner.nextLine();
		
		while(!(nextLine.trim().equals("")))
		{
			String[] specParts = nextLine.split(",");
			
			VHFFrequency frequency = this.getVHFFrequency(Integer.parseInt(specParts[1].trim()), Integer.parseInt(specParts[2].trim()));
			Latitude latitude = this.getLatitude(Integer.parseInt(specParts[3].trim()), Integer.parseInt(specParts[4].trim()), Double.parseDouble(specParts[5].trim()));
			Longitude longitude = this.getLongitude(Integer.parseInt(specParts[6].trim()), Integer.parseInt(specParts[7].trim()), Double.parseDouble(specParts[8].trim()));
			Altitude altitude = this.getAltitude(Double.parseDouble(specParts[9].trim()));
			AngleNavigational azimuth = new AngleNavigational(Double.parseDouble(specParts[10].trim()));
			
			Distance beaconDistance = new Distance(Double.parseDouble(specParts[11]));
			Altitude beaconAltitude = this.getAltitude(Double.parseDouble(specParts[12]));
			NavaidILSBeaconDescriptor markerOuter = new NavaidILSBeaconDescriptor(beaconDistance, beaconAltitude);
			beaconDistance = new Distance(Double.parseDouble(specParts[13]));
			beaconAltitude = this.getAltitude(Double.parseDouble(specParts[14]));
			NavaidILSBeaconDescriptor markerMiddle = new NavaidILSBeaconDescriptor(beaconDistance, beaconAltitude);
			beaconDistance = new Distance(Double.parseDouble(specParts[15]));
			beaconAltitude = this.getAltitude(Double.parseDouble(specParts[16]));
			NavaidILSBeaconDescriptor markerInner = new NavaidILSBeaconDescriptor(beaconDistance, beaconAltitude);
			
			
			CoordinateWorld3D position = this.getPosition(latitude, longitude, altitude);
			ComponentNavaidILS ils = new ComponentNavaidILS(specParts[0].trim(), position, azimuth, frequency, markerOuter, markerMiddle, markerInner);
			
			this.addNavaid(specParts[0].trim(), ils);
			
			nextLine = scanner.nextLine();
		}
	}
}
