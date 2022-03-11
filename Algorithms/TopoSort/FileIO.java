import java.io.File;
import java.io.IOException;
import java.util.Scanner;

public class FileIO 
{
	private File file;
	private Scanner fs;
	private int lineCount = 0;
	private Boolean eof = false;
	
	public FileIO(File file) throws IOException
	{
		this.file = file;
		this.fs = new Scanner(file);
		this.countLines();
	}
	
	public String nextLine() throws IOException
	{
		if(this.eof != true)
		{
			if(this.fs.hasNext())
			{
				return this.fs.next();
			}
			else
			{
				this.eof = true;
				this.close();
			}
		}
		return "";
	}
	
	private void countLines() throws IOException
	{
		while(fs.hasNext())
		{
			this.lineCount++;
			fs.next();
		}
		this.fs = new Scanner(this.file);
	}
	
	public void close(){this.fs.close();}
	public Boolean EOF() {return this.eof;}
	public int getLineCount() {return this.lineCount;}
}
